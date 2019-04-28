package AES;

public class main {
    public static void main(String[] args) {
        AES aes = new AES();
        aes.setDatos("prueba");
        aes.CifrarAES();
        System.out.println(aes.getLlaveGenerada());
    }
}
