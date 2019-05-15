from __future__ import print_function
from __future__ import absolute_import
from builtins import str
from builtins import range
from builtins import object
from .sharing import SecretSharer 
import string 
import binascii 
from . import constant
from .data_validator import is_valid 

class SecretGenerator(object): 
    def __init__(self, data, min_consensus_node = 3, total_number_of_node = 5):
        super(SecretGenerator, self).__init__()
        self.data = data
        self.min_consensus_node = min_consensus_node
        self.total_number_of_node = total_number_of_node
        self.secrets = [""] * self.total_number_of_node
        
    def is_valid_length(self, chunked_data): 
        if len(chunked_data) > constant.MAX_HEX_LENGTH :
            return False
        return True 

    def get_secrets_from_valid_hex_string(self, chunked_data): 
        if self.is_valid_length(chunked_data) == False: 
            raise ValueError("Data length must be less than " + str(constant.MAX_HEX_LENGTH) + " character") 

        if all(c in string.hexdigits for c in chunked_data.decode()) == False: 
            raise ValueError("Data must contain only hexdigits") 

        return SecretSharer.split_secret(chunked_data, self.min_consensus_node, self.total_number_of_node) 

    def get_secrets_from_hex_string(self, chunked_data): 
        data_len = len(chunked_data) 
        if data_len <= constant.MAX_HEX_LENGTH:
            return self.get_secrets_from_valid_hex_string(chunked_data)

        return "Hex string length must be less than " + str(constant.MAX_HEX_LENGTH) 

    def get_chunk(self, idx, data_len):

        chunked_data = ""
        for i in range(idx, min(data_len, idx+constant.MAX_CHUNK_LENGTH)):
            chunked_data += self.data[i]
        return chunked_data

    def add_caps(self):

        for node in range(self.total_number_of_node):
            self.secrets[node] = self.secrets[node] + "^"

    def add_chunk(self, chunkSecrets):

        for node in range(self.total_number_of_node): 
            self.secrets[node] = self.secrets[node] + chunkSecrets[node]
    
    def chunked_text_to_chunked_secret(self, idx, data_len):
        temp_data = self.get_chunk(idx, data_len)
        hex_temp_data = binascii.hexlify(temp_data.encode())
        return self.get_secrets_from_hex_string(hex_temp_data)

    def get_secrets_from_plain_text(self): 
        
        if is_valid(self.data) == False: 
            return "Data must contain only ascii character" 
        data_len = len(self.data)
        for idx in range(0, data_len, constant.MAX_CHUNK_LENGTH):

            chunkSecrets = self.chunked_text_to_chunked_secret(idx, data_len)
            if (idx > 0): self.add_caps()
            self.add_chunk(chunkSecrets)

        return self.secrets

    def run(self):
        return self.get_secrets_from_plain_text()

class SecretRecoverer(object):
    def __init__(self, secrets):
        super(SecretRecoverer, self).__init__()
        self.secrets = secrets
        self.data = None

    def recover_hex_string_secret(self, hex_string): 
        return SecretSharer.recover_secret(hex_string) 

    def special_case(self, secrets):
        temp_data = self.recover_hex_string_secret(secrets)
        recovered_data = str(binascii.unhexlify(temp_data))
        recovered_data = recovered_data[2:len(recovered_data)-1]
        return recovered_data

    def add_pieces_together(self, total_secrets):
        self.data = [[] for i in range(total_secrets)]
        for line in self.secrets:
            pieces = str(line).split('^') 
            for i in range(total_secrets):
                self.data[i].append(pieces[i])

    def decrypt_chunked_message(self, idx):
        hex_sub_key = self.recover_hex_string_secret(self.data[idx])
        sub_key = binascii.unhexlify(hex_sub_key)
        return sub_key

    def decrypt_whole_message(self, total_secrets):
        recovered_data = ""
        for i in range(total_secrets):
            temp = str(self.decrypt_chunked_message(i))
            recovered_data += temp[2:len(temp)-1]
        return str(recovered_data)

    def recover_plain_text_secret(self): 
        total_secrets = str(self.secrets[0]).count('^') + 1

        if total_secrets == 1: 
            return self.special_case(self.secrets)

        self.add_pieces_together(total_secrets)
        return self.decrypt_whole_message(total_secrets) 

    def run (self):
        return self.recover_plain_text_secret()


