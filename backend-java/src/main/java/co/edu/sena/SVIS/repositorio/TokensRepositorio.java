/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Interface.java to edit this template
 */
package co.edu.sena.SVIS.repositorio;

import co.edu.sena.SVIS.model.Token;
import java.sql.Connection;
import java.util.List;


/**
 *
 * @author julil
 */
public interface TokensRepositorio {
   void Crear(List<Token> tokens);
   Token MtBuscarYBloquear(Connection cn, Token oToken);
   void MtMarcarComoUsado(int idToken);
   boolean MtEmitirVoto();
   String MtBuscarTokenUsuario(int idEncuesta, int idUsuario);
}
