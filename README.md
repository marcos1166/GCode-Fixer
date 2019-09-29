# GCode Fixer
Un pedacito de codigo que arregla los archivos GCode que el FlatCAM genera.
Al generar un codigo me pasaba que habia puntos en la maquina en donde simplemente se levantaba y volvia a bajar en el mismo lugar sin cambiar de coordenadas en X e Y.
Esto pasaba por que terminaba de trabajar una linea y empezaba la siguiente, pero como no cambiaban las coordenadas era literalmente innecesario el cambio en Z.
Este script en PHP encuentra esos puntos en el codigo y los remueve, lo que me ahorra literal la mitad del tiempo de trabajo.
