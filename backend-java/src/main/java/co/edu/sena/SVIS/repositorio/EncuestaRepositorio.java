/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Interface.java to edit this template
 */
package co.edu.sena.SVIS.repositorio;

import co.edu.sena.SVIS.model.Encuesta;
import java.util.List;

/**
 *
 * @author julil
 */
public interface EncuestaRepositorio {
    List<Encuesta> ListarPorJornada();
    Encuesta Crear(Encuesta encuesta);
    List<Encuesta> ListarTodas();
    Encuesta Editar(Encuesta encuesta);
    
    
}
