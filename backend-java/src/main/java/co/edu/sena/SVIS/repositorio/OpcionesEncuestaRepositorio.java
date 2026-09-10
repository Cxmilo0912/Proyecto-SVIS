/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Interface.java to edit this template
 */
package co.edu.sena.SVIS.repositorio;

import co.edu.sena.SVIS.model.OpcionesEncuesta;
import java.util.List;

/**
 *
 * @author julil
 */
public interface OpcionesEncuestaRepositorio {
    List<OpcionesEncuesta> ListarPorEncuesta();
    OpcionesEncuestaRepositorio Crear();
}
