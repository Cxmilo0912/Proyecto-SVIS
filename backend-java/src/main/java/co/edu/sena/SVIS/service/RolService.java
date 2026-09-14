/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.service;

import co.edu.sena.SVIS.dto.RolView;
import co.edu.sena.SVIS.model.Rol;
import co.edu.sena.SVIS.repositorio.RolRepositorio;
import java.util.List;
import java.util.stream.Collectors;

/**
 *
 * @author julil
 */
public class RolService {

    private final RolRepositorio rolRepositorio;

    public RolService(RolRepositorio rolRepositorio) {
        this.rolRepositorio = rolRepositorio;
    }

    public List<RolView> MtListar() {
        return rolRepositorio.ListarRol().stream()
                .map(this::toView)
                .collect(Collectors.toList());
    }

    private RolView toView(Rol r) {
        RolView v = new RolView();
        v.Id = r.getId();
        v.Nombre = r.getNombre();
        return v;
    }

}
