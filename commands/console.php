<?php
echo getcwd();exit();
$line = trim(fgets(STDIN)); // 从 STDIN 读取一行
fscanf(STDIN, "%d\n", $number); // 从 STDIN 读取数字
printf("打印的是：%s:%d",$line,$number);
echo "Default \033[41mDefault\033[0m";

