/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.util;

import java.util.regex.Pattern;

/**
 *
 * @author julil
 */
public class Validador {

    private static final Pattern EMAIL_PATTERN = Pattern.compile("^[A-Za-z0-9+_.-]+@(.+)$");

    private static final Pattern NUMERIC_PATTERN = Pattern.compile("^\\d+$");

    //Validacion de si una cadena entra vacia o nula
    public static boolean esVacio(String texto) {
        return texto == null || texto.trim().isEmpty();
    }

    //Validacion de que el formato del correo sea la correcta
    public static boolean esEmailValido(String email) {
        if (esVacio(email)) {
            return false;
        }
        return EMAIL_PATTERN.matcher(email.trim()).matches();
    }

    //Validacion de que un texto sea solo numerico
    public static boolean esNumero(String texto) {
        if (esVacio(texto)) {
            return false;
        }
        return NUMERIC_PATTERN.matcher(texto.trim()).matches();
    }

    //Validar la longitud de un texto(documento, telefono)
    public static boolean tieneLongitudValida(String texto, int min, int max) {
        if (esVacio(texto)) {
            return false;
        }
        int longitud = texto.trim().length();
        return longitud >= min && longitud <= max;
    }

}
