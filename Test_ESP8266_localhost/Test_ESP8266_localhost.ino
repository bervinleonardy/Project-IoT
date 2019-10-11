/*
 * Monitoring Debit Air Pipa UPT Air Minum Kota Cimahi  
 * Copyright (c) 2019, https://github.com/bervinleonardy
 * All rights reserved.
 * Tugas Akhir Skripsi
 * Water Leakage Detection System. */

#include <ESP8266WiFi.h>
#include <WiFiClient.h> 
#include <ESP8266WebServer.h>
#include <ESP8266HTTPClient.h>

volatile byte jumlah_putaran_retikulasi1;//inisialisasi untuk mengukur jumlah putaran di pipa retikulasi awal
volatile byte jumlah_putaran_retikulasi2;//inisialisasi untuk mengukur jumlah putaran di pipa retikulasi akhir
volatile byte jumlah_putaran_dinas1;     //inisialisasi untuk mengukur jumlah putaran di pipa dinas awal
volatile byte jumlah_putaran_dinas2;     //inisialisasi untuk mengukur jumlah putaran di pipa dinas akhir

float retikulasiawal; //tipe data untuk hasil perhitungan sensor di pipa retikulasi awal 
float retikulasiakhir;//tipe data untuk hasil perhitungan sensor di pipa retikulasi akhir   
float dinasawal;      //tipe data untuk hasil perhitungan sensor di pipa dinas awal 
float dinasakhir;     //tipe data untuk hasil perhitungan sensor di pipa dinas akhir

uint8_t mainFlowPin   = D1;   //pin location of flow rate meter on main line
uint8_t secFlowPin    = D2;   //pin location of flow rate meter on secondary line
uint8_t thirdFlowPin  = 12;   //pin location of flow rate meter on main line
uint8_t fourthFlowPin = 2;    //pin location of flow rate meter on secondary line
unsigned long oldTime;
float konstanta = 5.75; //konstanta flow meter

/* Set these to your desired credentials. */
const char *ssid = "Epin Juara";  //ENTER YOUR WIFI SETTINGS
const char *password = "passwords";

//Web/Server address to read/write from 
const char *host = "192.168.1.13";   

//=======================================================================
//                    Power on setup
//=======================================================================

void setup() {
  delay(1000);
  Serial.begin(115200);
  WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
  delay(1000);
  WiFi.mode(WIFI_STA);        //This line hides the viewing of ESP as wifi hotspot
  
  WiFi.begin(ssid, password);     //Connect to your WiFi router
  Serial.println("");
  Serial.print("Connecting");
  
  pinMode(mainFlowPin  , INPUT_PULLUP); //initializes digital pin 2 as an input
  pinMode(secFlowPin   , INPUT_PULLUP); //initializes digital pin 3 as an input
  pinMode(thirdFlowPin , INPUT_PULLUP); //initializes digital pin 2 as an input
  pinMode(fourthFlowPin, INPUT_PULLUP); //initializes digital pin 3 as an input
      
  // Wait for connection
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }

  //If connection successful show IP address in serial monitor
  Serial.println("");
  Serial.print("Connected to ");
  Serial.println(ssid);
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());  //IP address assigned to your ESP
  //
  attachInterrupt(digitalPinToInterrupt(mainFlowPin)  , RPM_retikulasiawal , RISING);  //attaching main pulse counter interrupt to pin D1
  attachInterrupt(digitalPinToInterrupt(secFlowPin)   , RPM_retikulasiakhir, RISING);  //attaching secondary pulse counter interrupt to pin D2
  attachInterrupt(digitalPinToInterrupt(thirdFlowPin) , RPM_dinasawal      , RISING);  //attaching main pulse counter interrupt to pin D3
  attachInterrupt(digitalPinToInterrupt(fourthFlowPin), RPM_dinasakhir     , RISING);  //attaching secondary pulse counter interrupt to pin D4  
  oldTime = 0;
}

//=======================================================================
//                    Main Program Loop
//=======================================================================
void loop() {
  HTTPClient http;    //Declare object of class HTTPClient
  if((millis() - oldTime) > 1000) 
  { 
    String data_ret_awal,data_ret_akhir,data_dinas_awal ,data_dinas_akhir, getData, Link;
    
    jumlah_putaran_retikulasi1= 0; //resets pulse count for main flow sensor
    jumlah_putaran_retikulasi2= 0; //resets pulse count for secondary flow sensor
    jumlah_putaran_dinas1     = 0; //resets pulse count for main flow sensor
    jumlah_putaran_dinas2     = 0; //resets pulse count for secondary flow sensor
    
    sei();       //Enables interrupts
    delay (1000);//Wait 1 second to count pulses at each flow sensor
    cli();       //Disable interrupts    

    retikulasiawal  = ((1000.0 / (millis() - oldTime)) * jumlah_putaran_retikulasi1)/ konstanta; //(Main pulse frequency / 7.5Q) = flow rate in L/min
    retikulasiakhir = ((1000.0 / (millis() - oldTime)) * jumlah_putaran_retikulasi2)/ konstanta; //(sec pulse frequency / 7.5Q) = flow rate in  L/min
    dinasawal       = ((1000.0 / (millis() - oldTime)) * jumlah_putaran_dinas1)     / konstanta; //(Main pulse frequency / 7.5Q) = flow rate in L/min
    dinasakhir      = ((1000.0 / (millis() - oldTime)) * jumlah_putaran_dinas2)     / konstanta; //(sec pulse frequency / 7.5Q) = flow rate in  L/min
    
    oldTime = millis();

    data_ret_awal   = String(retikulasiawal,2);
    data_ret_akhir  = String(retikulasiakhir,2);
    data_dinas_awal = String(dinasawal,2);
    data_dinas_akhir= String(dinasakhir,2);
             
    //GET Data
    getData = "?retikulasiawal=" + data_ret_awal + "&retikulasiakhir=" + data_ret_akhir + "&dinasawal=" + data_dinas_awal + "&dinasakhir=" + data_dinas_akhir ;  //Note "?" added at front
    Link = "http://192.168.1.13/00_IOTUPTAMCIMAHI/log.php" + getData;
    
    http.begin(Link);     //Specify request destination
    
    int httpCode = http.GET();            //Send the request
    String payload = http.getString();    //Get the response payload
  
    Serial.println(httpCode);   //Print HTTP return code
    Serial.println(payload);    //Print request response payload
  
    http.end();  //Close connection
    
//    delay(5000);  //GET Data at every 5 seconds
  }
}

//=======================================================================
// Checks if pulse was detected, sets RPM increment and starts a timer
//=======================================================================
ICACHE_RAM_ATTR void RPM_retikulasiawal ()  //This is the function that the interupt calls
{
  jumlah_putaran_retikulasi1+=1;            //This function measures the rising and falling edge of the hall effect sensors signal
}

ICACHE_RAM_ATTR void RPM_retikulasiakhir () //This is the function that the interupt calls
{
  jumlah_putaran_retikulasi2+=1;            //This function measures the rising and falling edge of the hall effect sensors signal
}

ICACHE_RAM_ATTR void RPM_dinasawal ()      //This is the function that the interupt calls
{
  jumlah_putaran_dinas1+=1;                //This function measures the rising and falling edge of the hall effect sensors signal
}

ICACHE_RAM_ATTR void RPM_dinasakhir ()     //This is the function that the interupt calls
{
  jumlah_putaran_dinas2+=1;                //This function measures the rising and falling edge of the hall effect sensors signal
}
