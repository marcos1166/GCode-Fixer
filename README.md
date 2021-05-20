# GCode Fixer
Un pedacito de codigo que arregla los archivos GCode que el FlatCAM genera.

FlatCAM es un software hecho para generar codigo GCode a partir de archivos Gerber o Vectoriales. Yo lo utilizaba para un router CNC con el que hacia circuitos impresos.

Al utilizarlo me pasaba que, al poner a funcionar la maquina, habia puntos en donde simplemente se levantaba y volvia a bajar en el mismo lugar sin cambiar de coordenadas en X e Y.

Esto pasaba por que terminaba de trabajar una linea y empezaba la siguiente. Es decir, en lugar de unir 2 lineas consecutivas las trataba lineas separadas. Pero como no cambiaban las coordenadas X e Y era literalmente innecesario el cambio en el eje Z.

Este script en PHP encuentra esos puntos en el codigo y los remueve, lo que reduce a la mitad el tiempo de trabajo.
