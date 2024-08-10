import sys
import urllib.parse
def shift_unicode_from_file(filename, shift_value):
    with open(filename, 'r', encoding='utf-8') as file:
        input_chars = file.read()
        shifted_characters = ""
        try:
            for char in input_chars:
                unicode_value = ord(char)
                shifted_unicode = chr(unicode_value + shift_value)
                shifted_characters += shifted_unicode
        except ValueError:
            shifted_characters = "超出Unicode范围！"
        return shifted_characters
filename = "wait.txt"
shift_value = int(sys.argv[1])
result = shift_unicode_from_file(filename, shift_value)
with open("out.txt", "w" , encoding='utf-8') as out_file:
    out_file.write(result)
encoded_result = urllib.parse.quote(''.join(result))
print(encoded_result)