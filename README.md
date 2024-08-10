# Radicals-Chinese-Characters-Converter-Plus
在原偏旁部首转换器的分支添加了更多新奇的功能并改良了部分代码
* 凯撒密码unicode加密：每个字符都有它的Unicode码，将这些Unicode编码前后移动特定的数就是一种很新的凯撒加密
* UU加密：全名“Unicode-Url加密”，一种不适用于Url保留字符的加密形式，将原文本的Unicode文本切割为两个一组并重新编排为Url格式（数量为单数是会用指定的字符填充），很粗糙的加密格式

此外还修了一些bug，偏旁部首的转换与main无异。
