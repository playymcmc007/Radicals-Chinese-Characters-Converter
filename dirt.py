import json
import urllib.parse
def load_conversion_dictionary(file_paths):
    combined_dict = {}
    for file_path in file_paths:
        with open(file_path, "r", encoding="utf-8") as file:
            data = json.load(file)
            combined_dict.update(data)
    return combined_dict
def convert_string(output, conversion_dict):
    converted_chars = []
    non_converted_chars = []
    for char in output:
        converted_string = conversion_dict.get(char)
        if converted_string is not None:
            converted_chars.append(converted_string)
        else:
            converted_chars.append(char)
            non_converted_chars.append(char)
    return converted_chars, list(set(non_converted_chars))
conversion_dict = load_conversion_dictionary(["土.json","符号.json"])
with open("wait.txt", "r", encoding="utf-8") as file:
    input_text = file.read().strip()
output = list(input_text)
converted_chars, non_converted_chars = convert_string(output, conversion_dict)
converted_result = ''.join(converted_chars).encode('utf-8').decode('utf-8')
with open("out.txt", "w", encoding="utf-8") as file:
    file.write(converted_result)
with open("dis.txt", "w", encoding="utf-8") as file:
    file.write("".join(non_converted_chars))
encoded_result = urllib.parse.quote(''.join(converted_chars))
print(encoded_result)
