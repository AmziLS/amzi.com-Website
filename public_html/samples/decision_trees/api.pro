:- ensure_loaded(list).
:- import(list).

new_fund(Name) :-
   clear,
   ask(fixed_income, FI),
   ask(bond_universe_classification, BU),
   assert(fund( Name, [fixed_income = FI, bond_universe_classification = BU] )).

get_fund_attribute(Name, Attr, Val) :-
   fund(Name, AttrsVals),
   member(Attr = Val, AttrsVals).

