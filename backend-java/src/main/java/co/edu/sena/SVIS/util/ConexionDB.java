/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Classes/Class.java to edit this template
 */
package co.edu.sena.SVIS.util;

import com.zaxxer.hikari.HikariConfig;
import com.zaxxer.hikari.HikariDataSource;
import java.io.IOException;
import java.io.InputStream;
import java.sql.Connection;
import java.sql.SQLException;
import java.util.Properties;
import javax.sql.DataSource;

/**
 *
 * @author Admin
 */
public class ConexionDB {
    private static volatile DataSource dataSource;

    private ConexionDB() {
    }

    public static DataSource getDataSource() {
        if (dataSource == null) {
            synchronized (ConexionDB.class) {
                if (dataSource == null) {
                    dataSource = construir();
                }
            }
        }
        return dataSource;
    }

    public static Connection getConnection() throws SQLException {
        return getDataSource().getConnection();
    }

    private static DataSource construir() {
        Properties p = cargarPropiedades();

        try { Class.forName("com.mysql.cj.jdbc.Driver"); } catch (Exception e) {}
        HikariConfig cfg = new HikariConfig();
        cfg.setDriverClassName("com.mysql.cj.jdbc.Driver");
        cfg.setJdbcUrl(valor(p, "db.url", "EVENTOS_DB_URL",
                "jdbc:mysql://localhost:3306/dbsvis?serverTimezone=UTC&useSSL=false&allowPublicKeyRetrieval=true"));
        cfg.setUsername(valor(p, "db.user", "EVENTOS_DB_USER", "root"));
        cfg.setPassword(valor(p, "db.password", "EVENTOS_DB_PASSWORD", ""));
        cfg.setMaximumPoolSize(Integer.parseInt(valor(p, "db.poolSize", "EVENTOS_DB_POOL", "5")));
        cfg.setPoolName("eventos-pool");
        cfg.setConnectionTimeout(10000);

        return new HikariDataSource(cfg);
    }

    private static Properties cargarPropiedades() {
        Properties p = new Properties();
        try (InputStream in = ConexionDB.class.getClassLoader().getResourceAsStream("db.properties")) {
            if (in != null) {
                p.load(in);
            }
        } catch (IOException e) {
            // Si no hay archivo, se usan variables de entorno o valores por defecto.
        }
        return p;
    }

    private static String valor(Properties p, String clave, String envKey, String porDefecto) {
        String v = System.getenv(envKey);
        if (v == null || v.trim().isEmpty()) {
            v = p.getProperty(clave);
        }
        if (v == null || v.trim().isEmpty()) {
            v = porDefecto;
        }
        return v;
    }
    
}
