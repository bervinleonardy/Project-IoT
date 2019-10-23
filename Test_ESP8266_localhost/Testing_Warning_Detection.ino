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

float retikulasiawal; //tipe data untuk hasil perhitungan sensor di pipa retikulasi awal 
float retikulasiakhir;//tipe data untuk hasil perhitungan sensor di pipa retikulasi akhir   

// defines pins numbers ultrasonic
const int trigPin = D8;  //D4
const int echoPin = D7;  //D3
// defines variables
long durasi;
float jarak,volume,tekanan, tekananPSi;

uint8_t mainFlowPin   = D1;   //pin location of flow rate meter on main line
uint8_t secFlowPin    = D2;   //pin location of flow rate meter on secondary line
unsigned long oldTime;
float konstanta = 5.75; //konstanta flow meter

//LED blink blink & Buzzer
const int ledPin = D5;
const int buzzerPin = D6;
int i=0;

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
  //Sensor Ultrasonic
  pinMode(trigPin, OUTPUT); // Sets the trigPin as an Output
  pinMode(echoPin, INPUT); // Sets the echoPin as an Input  
  //Sensor Waterflow
  pinMode(mainFlowPin  , INPUT_PULLUP); //initializes digital pin 2 as an input
  pinMode(secFlowPin   , INPUT_PULLUP); //initializes digital pin 3 as an input
  //LED dan Buzzer
  pinMode(ledPin, OUTPUT); 
  pinMode(buzzerPin, OUTPUT);   
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
  oldTime = 0;
}

//=======================================================================
//                    Main Program Loop
//=======================================================================
void loop() {
//  HTTPClient http;    //Declare object of class HTTPClient
  // Clears the trigPin
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);      
  if((millis() - oldTime) > 1000) 
  { 
    String data_retikulasi_awal,data_retikulasi_akhir, ultrasonic, getData, Link;
    // Sets the trigPin on HIGH state for 10 micro seconds
    digitalWrite(trigPin, HIGH);
    delayMicroseconds(10);
    digitalWrite(trigPin, LOW);
    
    // Reads the echoPin, returns the sound wave travel time in microseconds
    durasi = pulseIn(echoPin, HIGH);
    // Calculating the distance and volume
    jarak = durasi*0.034/2; 
    //rumus volume pxlxt ~ cm3 = /1000 ~ Liter   
    volume = 30 * 17 * (24 - jarak);
    //rumus tekanan air
    tekanan = 997 * 9.8 * (24 - jarak);
    tekananPSi = tekanan * 0.145037738; 
    
    jumlah_putaran_retikulasi1= 0; //resets pulse count for main flow sensor
    jumlah_putaran_retikulasi2= 0; //resets pulse count for secondary flow sensor
    
    sei();       //Enables interrupts
    delay (1000);//Wait 1 second to count pulses at each flow sensor
    cli();       //Disable interrupts    

    retikulasiawal  = ((1000.0 / (millis() - oldTime)) * jumlah_putaran_retikulasi1)/ konstanta; //(Main pulse frequency / 7.5Q) = flow rate in L/min
    retikulasiakhir = ((1000.0 / (millis() - oldTime)) * jumlah_putaran_retikulasi2)/ konstanta; //(sec pulse frequency / 7.5Q) = flow rate in  L/min
    
    oldTime = millis();

    Serial.print ("Debit Air Pipa Retikulasi Awal : ");
    Serial.print (retikulasiawal,2); //Prints the number calculated above
    Serial.println (" L/detik");
    Serial.print ("Debit Air Pipa Retikulasi Akhir: ");
    Serial.print (retikulasiakhir,2); //Prints the number calculated above
    Serial.println (" L/detik");
    Serial.print ("Volume Reservoir: ");
    Serial.print (volume/1000); //Prints the number calculated above
    Serial.println (" Liter");    
    Serial.print ("Tekanan Reservoir: ");
    Serial.print (tekananPSi/1000); //Prints the number calculated above
    Serial.println (" PSi");
    Serial.print ("Status: ");
    if (retikulasiakhir <= 0.50){
      //  delay(800); 
        for(i=700;i<800;i++){ 
        digitalWrite(ledPin,HIGH);  
        tone(buzzerPin,i);
        delay(15);
        }
        
      //  delay(700);
        for(i=800;i>700;i--){ 
        digitalWrite(ledPin,LOW);     
        tone(buzzerPin,i);
        delay(15);
        }      
       Serial.println ("Bocor\n");
      }     
    else if (retikulasiakhir >= 0.50) {
      noTone(buzzerPin);
      Serial.println ("Aman\n");
      }
//    data_retikulasi_awal   = String(retikulasiawal,2);
//    data_retikulasi_akhir  = String(retikulasiakhir,2);
//             
//    //GET Data
//    getData = "?retikulasiawal=" + data_retikulasi_awal + "&retikulasiakhir=" + data_retikulasi_akhir + "&ultrasonic=" + volume ;  //Note "?" added at front
//    Link = "http://192.168.1.13/00_IOTUPTAMCIMAHI/log_din_det.php" + getData;
//    
//    http.begin(Link);     //Specify request destination
//    
//    int httpCode = http.GET();            //Send the request
//    String payload = http.getString();    //Get the response payload
//  
//    Serial.println(httpCode);   //Print HTTP return code
//    Serial.println(payload);    //Print request response payload
//  
//    http.end();  //Close connection
    
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
