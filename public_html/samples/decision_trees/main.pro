main :-
  new_fund(abc),
  get_fund_attribute(abc, A, V),
  output(A = V),
  fail.
main.

output(X) :-
  write(X), nl.

prompt(P, V) :-
   write(P), tab(1),
   read_string(X),
   string_term(X, V).
