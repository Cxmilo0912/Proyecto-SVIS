/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.service;

import co.edu.sena.SVIS.dto.DashboardViewAdmin;
import co.edu.sena.SVIS.repositorio.DashboardAdminRepositorio;

/**
 *
 * @author Admin
 */
public class DashboardAdminService {

    private final DashboardAdminRepositorio dashboardReposittorio;

    public DashboardAdminService(DashboardAdminRepositorio dashboardReposittorio) {
        this.dashboardReposittorio = dashboardReposittorio;
    }

    public DashboardViewAdmin MtObtenerIndicadores() {

        DashboardViewAdmin vista = new DashboardViewAdmin();

        vista.EncuestaActivas = dashboardReposittorio.MtEncuestasActivas();
        vista.VotantesHabilitados = dashboardReposittorio.MtVotantesHabilitados();
        vista.SufragiosEmitidos = dashboardReposittorio.MtSufragiosEmitidos();
        
         vista.ParticipacionGlobal = vista.VotantesHabilitados > 0
                ? (vista.SufragiosEmitidos * 100.0) / vista.VotantesHabilitados
                : 0.0;

        return vista;

    }
}
