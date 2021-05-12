:- op(980, xfx, ::).
:- op(970, xfx, when).
:- op(970, xfx, :=).
:- op(970, xfx, ==>).
:- op(970, xfx, <==).
:- op(950, xfy, or).
:- op(950, xfy, and).

/* Predefined Prolog Operators
The following Prolog operators are declared at initialization time. They can be subsequently redefined by using the op predicate (but it's not a good idea because they are used by the Prolog system).

:- (op(1200, xfx, [:-, -->])).
:- (op(1200, fx, [?-, :-])).
:- (op(1100, fx, [import, export, dynamic, multifile, discontiguous, sorted,
                 indexed])).
:- (op(1100, xfy, ';')).
:- (op(1050, xfy, ->)).
:- (op(1000, xfy, ',')).
:- (op(900, fy, [\+, not, once])).
:- (op(900, fy, [?, bug])).
:- (op(700, xfx, [=, \=, is, =.., ==, \==, =:=, ~=, =\=, <, >, =<, >=, @<,
                 @>, @=<, @>=])).
:- (op(600, xfy, :)).
:- (op(500, yfx, [+, -, /\, \/, xor])).       % moved \ here from 900 fy
:- (op(400, yfx, [rem, mod, divs, mods, divu, modu])). % new ones and mod
:- (op(400, yfx, [/, //, *, >>, <<])).
:- (op(200, xfx, **)).
:- (op(200, xfy, ^)).
:- (op(200, fy, [+, -, \])).
*/