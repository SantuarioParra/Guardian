import argparse

import Crypto.Cipher.AES as AES
import Crypto.Random as random
import base64 as base64


def aesc(archivo):
    key = random.get_random_bytes(16)
    try:
        file = open(archivo, 'rb')
        data = file.read()
        file.close()
        cipher = AES.new(key, AES.MODE_CFB)
        cipherData = cipher.iv + cipher.encrypt(data)
        file = open(archivo, 'wb')
        file.write(cipherData)
        file.close()
        return base64.standard_b64encode(key)
    except FileNotFoundError:
        return "404"


def aesd(archivo, key):
    key = base64.standard_b64decode(key)
    try:
        file = open(archivo, 'rb')
        data = file.read()
        file.close()
        iv = data[:AES.block_size]
        cipher = AES.new(key, AES.MODE_CFB, iv)
        cipherDData = cipher.decrypt(data[AES.block_size:])
        file = open(archivo, 'wb')
        file.write(cipherDData)
        file.close()
        return "200"
    except FileNotFoundError:
        return "404"

def main():
    parser = argparse.ArgumentParser()
    parser.add_argument("-c", "--cifrar", help="Cifra el archivo y devuelve la llave con el archivo cifrado",
                        action="store_true")
    parser.add_argument("-d", "--descifrar", help="Descifra el archivo seleccionado",
                        action="store_true")
    parser.add_argument("-f", "--file", help="Nombre del archivo")
    parser.add_argument("-k", "--key", help="Llave base64 del archivo")
    args = parser.parse_args()

    if args.cifrar:
        key = aesc(args.file)
        print(key)

    if args.descifrar:
        salida = aesd(args.file, args.key)
        print(salida)


if __name__ == '__main__':
    main()


