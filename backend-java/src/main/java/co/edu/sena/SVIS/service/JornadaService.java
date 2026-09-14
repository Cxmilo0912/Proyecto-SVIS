/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.service;

import co.edu.sena.SVIS.dto.JornadaView;
import co.edu.sena.SVIS.model.Jornada;
import co.edu.sena.SVIS.repositorio.JornadaRepositorio;
import java.util.ArrayList;
import java.util.List;

/**
 *
 * @author Admin
 */
public class JornadaService {
    
    private final JornadaRepositorio jornadaRepositorio;

    public JornadaService(JornadaRepositorio jornadaRepositorio) {
        this.jornadaRepositorio = jornadaRepositorio;
    }
    
    public List<JornadaView> MtListarJornadas(){
        List<Jornada> lista = jornadaRepositorio.ListarJornada();
        List<JornadaView>listaVista = new ArrayList<>();
        
        for(Jornada j : lista){
            JornadaView jornada = new JornadaView();
            jornada.setId(j.getId());
            jornada.setNombre(j.getNombre());
            listaVista.add(jornada);
        }
        return listaVista;
    }
    
}
