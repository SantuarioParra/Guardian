package AES;

import javax.crypto.KeyGenerator;
import javax.crypto.SecretKey;
import java.security.NoSuchAlgorithmException;
import java.util.Base64;

public class AES {
    private int modoOperacion;
    private String datos;
    private String llaveGenerada;

    public String CifrarAES(){
        try {
            KeyGenerator keyGenerator = KeyGenerator.getInstance("AES");
            keyGenerator.init(128);
            SecretKey secretKey = keyGenerator.generateKey();
            this.llaveGenerada = Base64.getEncoder().encodeToString(secretKey.getEncoded()); //Se pasa la llave generada a la variable

        } catch (NoSuchAlgorithmException e) {
            e.getMessage();
        }
        return datos;
    }

    public String getDatos() {
        return datos;
    }

    public void setDatos(String datos) {
        this.datos = datos;
    }

    public String getLlaveGenerada() {
        return llaveGenerada;
    }
}
