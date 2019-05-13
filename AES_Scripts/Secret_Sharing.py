

import argparse
import base64 as b64
from binascii import hexlify
from Cryptodome.Protocol.SecretSharing import Shamir


def sdividir(key, minrecu, maxrecu):
    key = b64.standard_b64decode(key)
    secreto = Shamir.split(minrecu, maxrecu, key)
    for idx, fragmento in secreto:
        fragmento = hexlify(fragmento)
        print("Index #%d: %s" % (idx, fragmento))

def main():
    parser = argparse.ArgumentParser()
    parser.add_argument("-u", "--unir", help="Une el secreto a partir de los fragmentos y entrega la llave",
                        action="store_true")
    parser.add_argument("-d", "--divide", help="Dividi del secreto en fragmentos ",
                        action="store_true")
    parser.add_argument("-k", "--key", help="Llave base64 del archivo")
    args = parser.parse_args()

    sdividir(args.key, 5, 10)


if __name__ == '__main__':
    main()
