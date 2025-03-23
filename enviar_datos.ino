#include <WiFi.h>
#include <HTTPClient.h>

#define PIN_LDR 34  // Pin del sensor LDR

const char* ssid = "INFINITUMD6CD";
const char* password = "Li8Gc1Cc3n";
const char* server = "http://192.168.1.68/urequestESP32/guardar_datos.php";  // IP de tu servidor

void setup() {
    Serial.begin(115200);
    WiFi.begin(ssid, password);
    
    while (WiFi.status() != WL_CONNECTED) {
        delay(500);
        Serial.print(".");
    }
    Serial.println("\nConectado a WiFi");
}

void loop() {
    if (WiFi.status() == WL_CONNECTED) {
        HTTPClient http;
        
        int valorLDR = analogRead(PIN_LDR);
        int luzPorcentaje = map(valorLDR, 0, 4095, 0, 100);
        String nivelLuz = String(luzPorcentaje) + "%";

        String url = String(server) + "?valor=" + nivelLuz;
        
        http.begin(url);
        int httpCode = http.GET();
        
        if (httpCode > 0) {
            String respuesta = http.getString();
            Serial.println("Servidor: " + respuesta);
        } else {
            Serial.println("Error en la conexión");
        }
        
        http.end();
    } else {
        Serial.println("WiFi desconectado");
    }
    
    delay(5000);
}
