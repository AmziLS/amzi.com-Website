% reasoner.pro

:- include('opdefs.pro').

clear :-
   retractall(known(_,_)).

% it's already known
ask(Fact,Value) :-
   known(Fact,X),
   !,
   Value = X.
% figure it out from a decision tree
ask(Fact,Value) :-
   dtree_node( DTree:_, [terminal, fact = Fact, _]),
   climb(DTree:1, X),
   assert(known(Fact, X)),
   !,
   Value = X.
% ask the user
ask(Fact,Value) :-
   fact( Fact, [prompt = english:P]),
   prompt(P, X),
   assert(known(Fact,X)),
   !,
   Value = X.

climb(DTree:N, Value) :-
%  write(climbing:DTree:N), nl,
   dtree_node( DTree:N, [terminal, fact = Fact, value = Value]),
   !.
climb(DTree:N, Value) :-
   dtree_node( DTree:N, [criteria = C, yes = YES, no = NO]),
%  write(testing:C), nl,
   ( test(C)-> climb(YES, Value); climb(NO, Value) ).
   
test((A and B)) :-
   !,
   test(A),
   test(B).
test((A or B)) :-
   !,
   ( test(A) ; test(B) ).
test(C) :-
   C =.. [CompareOp, A, B],
   evaluate(A, X),
   evaluate(B, Y),
   Z =.. [CompareOp, X, Y],
   call(Z).

evaluate(N, N) :-
   number(N),
   !.
evaluate(S, S) :-
   string(S),
   !.
evaluate(C, Z) :-
   C =.. [MathOp, A, B],
   !,
   evaluate(A, X),
   evaluate(B, Y),
   Exp =.. [MathOp, X, Y],
   Z is Exp,
   !.
evaluate(A, X) :-
   ask(A, X),
   !.
evaluate(A, error(no_value, A)).
   