%
% knowledge for decision trees about funds
%

:- include('opdefs.pro').

% Fixed Income classification decision tree
dtree_node(fixed_income_relevance:1, [
   criteria =
     ( fixed_income_percentage >= 90 ),
   yes = fixed_income_relevance:2,
   no = fixed_income_relevance:4 ]).
dtree_node(fixed_income_relevance:2, [
   criteria =
     ( convertibles_percentage =< 70 and
       asset_backed_percentage + mortgage_backed_percentage =< 90 and
       equity_percentage == 0 and
       cash_percentage + other_percentage =< 10 ),
   yes = fixed_income_relevance:3,
   no = fixed_income_relevance:4 ]).
dtree_node(fixed_income_relevance:3, [
   terminal,
   fact = fixed_income,
   value = true ]).
dtree_node(fixed_income_relevance:4, [
   terminal,
   fact = fixed_income,
   value = false ]).

% Bond Universe decision tree

dtree_node(bond_universe:1, [
   criteria =
     ( flexibility == `yes` ),
   yes = bond_universe:10,
   no  = bond_universe:2 ]).
dtree_node(bond_universe:2, [
   criteria =
     ( emerging_market_exposure_percent >= 30 ),
   yes = bond_universe:4,
   no  = bond_universe:3 ]).
dtree_node(bond_universe:3, [
   criteria =
     ( junk_emerging_market_bond_exposure_percent >= 10
       or
       convertibles_percentage >= 20
       or
       asset_backed_percentage + mortgage_backed_percentage =< 20 ),
   yes = bond_universe:8,
   no  = bond_universe:5 ]).
dtree_node(bond_universe:4, [
   criteria =
     ( emerging_market_exposure_percent >= 60 ),
   yes = bond_universe:9,
   no  = bond_universe:8 ]).
dtree_node(bond_universe:5, [
   criteria =
     ( weighted_average_modified_duration =< 365
       or
       weighted_average_maturity =< 60 ),
   yes = bond_universe:6,
   no  = bond_universe:7 ]).
dtree_node(bond_universe:6, [
   terminal,
   fact = bond_universe_classification,
   value = money_market ]).
dtree_node(bond_universe:7, [
   terminal,
   fact = bond_universe_classification,
   value = regular ]).
dtree_node(bond_universe:8, [
   terminal,
   fact = bond_universe_classification,
   value = unconstrained ]).
dtree_node(bond_universe:9, [
   terminal,
   fact = bond_universe_classification,
   value = emerging_markets ]).
dtree_node(bond_universe:10, [
   terminal,
   fact = bond_universe_classification,
   value = flexible ]).

% facts to support decisions
fact(asset_backed_percentage, [
   prompt = english : `What percentage is asset backed?` ]).
fact(cash_percentage, [
   prompt = english : `What percentage is cash?` ]).
fact(convertibles_percentage, [
   prompt = english : `What percentage is convertibles?` ]).
fact(emerging_market_exposure_percent, [
   prompt = english : `What is the percent exposure to emerging markets?` ]).
fact(equity_percentage, [
   prompt = english : `What percentage is equities?` ]).
fact(flexibility, [
   prompt = english : `Can the fund adjust flexibly it's current, emerging markets, credit quality and/or interest rate exposure?` ]).
fact(fixed_income_percentage, [
   prompt = english : `What percentage is fixed income?` ]).
fact(junk_emerging_market_bond_exposure_percent, [
   prompt = english : `What percent exposure to non-investment grade bonds that are in emerging market countries?` ]).
fact(mortgage_backed_percentage, [
   prompt = english : `What percentage is mortgage backed?` ]).
fact(other_percentage, [
   prompt = english : `What percentage is others?` ]).
fact(weighted_average_maturity, [
   prompt = english : `What is the weighted average maturity in days?` ]).
fact(weighted_average_modified_duration, [
   prompt = english : `What is the weighted-average modified duration in days?` ]).
   