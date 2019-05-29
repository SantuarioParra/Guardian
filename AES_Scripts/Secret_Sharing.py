

import argparse
import base64 as b64
from binascii import hexlify, unhexlify
from secretsharingng import SecretSharer


def sdividir(key, minrecu, maxrecu):
    resultado = ""
    key = b64.standard_b64decode(key)
    key = hexlify(key)
    secreto = SecretSharer.split_secret(key, int(minrecu), int(maxrecu))
    #print(secreto)
    for fragmento in secreto:
        resultado +=str(fragmento)+','
    print(resultado)


def sunir(fragmentos, minrecu):
    key = str(fragmentos)
    key = key.split(",")
    key = [item for item in key if item]
    key = sorted(key)
    secreto = SecretSharer.recover_secret(key[:int(minrecu)])
    secreto = unhexlify(secreto)
    secreto= b64.standard_b64encode(secreto)
    print(secreto)

def main():
    parser = argparse.ArgumentParser()
    parser.add_argument("-u", "--unir", help="Une el secreto a partir de los fragmentos y entrega la llave",
                        action="store_true")
    parser.add_argument("-d", "--divide", help="Dividi del secreto en fragmentos ",
                        action="store_true")
    parser.add_argument("-k", "--key", help="Llave base64 del archivo")
    parser.add_argument("-min", "--minrecu", help="Minimo recuperacion")
    parser.add_argument("-max", "--maxrecu", help="Total fragmentos")
    parser.add_argument("-f", "--fragment", help="Cadena de fragmentos")
    args = parser.parse_args()

    if args.divide:
        sdividir(args.key, args.minrecu, args.maxrecu)
    if args.unir:
        sunir(args.fragment, args.minrecu)


if __name__ == '__main__':
    main()
