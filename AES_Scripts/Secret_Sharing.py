

import argparse
import base64 as b64
from binascii import hexlify,unhexlify
from secretsharingng import SecretSharer


def sdividir(key, minrecu, maxrecu):
    key = b64.standard_b64decode(key)
    key = hexlify(key)
    secreto = SecretSharer.split_secret(key, minrecu, maxrecu)
    print(secreto)
    for fragmento in secreto:
      print(fragmento)


def sunir(fragmentos, minrecu):
    key = str(fragmentos)
    key = key.split(",")
    secreto = SecretSharer.recover_secret(key[:minrecu])
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
    args = parser.parse_args()

    sdividir(args.key, 5, 10)
    sunir("1-b9209d08140c42f1eedf95fb2bad89ded8db26616465980a9adb9553daa08d66,3-1c672c8bd6c448967fe2ed5718b6eb366936965d46f7a6bd520d67ab03abebae,7-d1a28b8d5c109251e96d67a8fc31b8d34178670385add26c97c4f9cacbdbec7b,a-80a7e19ca3d5d5bc7436aae15d9bdd8513261d6c8d524f7cec523b8d8ee36324,2-5aec7468fb6209dbbca4313b08fd65a548308a7d6826c2dc0a5411b28e86741f", 5)
    if "Wjud5jRTwdPz9TRJWCCLPL7DwjBtXkIGCRFROJEhgUA=" =="Wjud5jRTwdPz9TRJWCCLPL7DwjBtXkIGCRFROJEhgUA=":
        print("son iguales")
    else:
        print("algo murio")

if __name__ == '__main__':
    main()
