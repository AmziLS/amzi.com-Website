% RUBLOAD - Loads the necessary files for solving Rubik's Cube.

:-nl,write('loading rubik'),nl,
    debug_consult('rubik.pro').
:-write('loading rubdata'),nl,
    debug_consult('rubdata.pro').
:-write('loading rubdisp'),nl,
    debug_consult('rubdisp.pro').
:-write('loading rubedit'),nl,
    debug_consult('rubedit.pro').
:-write('loading rubhelp'),nl,
    debug_consult('rubhelp.pro').
:-write('loading rubhist'),nl,
    debug_consult('rubhist.pro').
:-write('loading rubmov'),nl,
    debug_consult('rubmov.pro').
:-write('rubik loaded'),nl.
