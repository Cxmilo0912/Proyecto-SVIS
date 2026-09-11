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
    List<Encuesta> ListarPorJornada(int IdJornada);
    void Crear(Encuesta encuesta,String Opciones );
    List<Encuesta> ListarTodas();
    void Editar(Encuesta encuesta,String OpcionesActualizadas);
    List<Encuesta> ListarEncuesta(int IdEncuesta);
    
    
}
