import sys
import urllib.parse   
def url_encode_and_remove_percent(input_string, special_characters):  
    encoded_string = urllib.parse.quote(input_string, safe=special_characters)  
    return encoded_string.replace('%', '')  
def unicode_decode(input_string):  
    parts = input_string.split('-')  
    decoded_chars = []  
    for part in parts:  
        if len(part) == 6 and all(c in '0123456789abcdefABCDEF' for c in part[2:]):  
            code_point = int(part[2:], 16)  
            decoded_chars.append(chr(code_point))  
        else:  
            decoded_chars.append(part)  
    return ''.join(decoded_chars)  
with open("wait.txt", 'r', encoding='utf-8') as file:
    input_string = file.read()  
result = urllib.parse.quote(input_string)
encoded_result = url_encode_and_remove_percent(input_string, '') 
bu = str(1)
if len(sys.argv) > 1:
    bu = str(sys.argv[1])
padding_length = 4 - (len(encoded_result) % 4)  
if padding_length != 4:  
    encoded_result += bu * padding_length  
result_with_delimiter = '-'.join(f"\\u{encoded_result[i:i+4]}" for i in range(0, len(encoded_result), 4))  
decoded_string = unicode_decode(result_with_delimiter)  
decoded_string = decoded_string.replace('\\u', '') 
with open("text.txt", "w" , encoding='utf-8') as text_file:
    text_file.write("转换为Urlcode：")
with open("text.txt", "a" , encoding='utf-8') as text_file:
    text_file.write(result)
    text_file.write("<br/>移除百分号并补足字符：")
    text_file.write(encoded_result)
    text_file.write("<br/>UU加密处理：")
    text_file.write(result_with_delimiter)
decoded_string = urllib.parse.quote(decoded_string)
print(decoded_string)