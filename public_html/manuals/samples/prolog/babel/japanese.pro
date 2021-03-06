%-------------
% Japanese
%

jsentence( identity(subj(S),obj(O)) ) -->
  jsubject(S), jobject(O), jisverb(_), jperiod.
jsentence( identity_question(subj(S),obj(O)) ) -->
  jsubject(S), jobject(O), jisverb(_), [ka], jperiod.
jsentence( identity(not,subj(S),obj(O)) ) -->
  jsubject(S), jobject(O), jisnotverb(_), jperiod.
jsentence( attribute(subj(S),attr(A)) ) -->
  jsubject(S), jadjlist(A), jisverb(_), jperiod.
jsentence( attribute(not,subj(S),attr(A)) ) -->
  jsubject(S), jadjlist(A), jisnotverb(_), jperiod.
jsentence( attribute_question(subj(S),attr(A)) ) -->
  jsubject(S), jadjlist(A), jisverb(_), ['か'], jperiod. % ka

jsubject(S) --> jpronoun(S), ['は'].  % wa, but uses ha?
jsubject(S) --> jnounphrase(S), ['は'].
jsubject(it) --> [].

jobject(O) --> jnounphrase(O).

jnounphrase(NP) --> [X], { jphrase_word(NP, X) }.

jnounphrase(noun(N,MODs)) --> jadjlist(MODs), jnoun(N).

jisverb(M) --> [X], { dict(jdict,M,X,R,[ps=verb,is,positive]) }.

jisnotverb(not(is)) --> [X,Y],
  { dict(jdict,_,X,[ps=verb,is,negative]),
    dict(jdict,_,Y,[ps=verbneg]) }.

jphrase_word(noun(school,[junior,high]), chuugakkoo).
jphrase_word(noun(school,[senior,high]), kootoogakkoo).
jphrase_word(noun(school,[grade]), shoogakko).

jpronoun(M) --> [X], { dict(jdict,M,X,R,[ps=pronoun]) }.

jnoun(M) --> [X], { dict(jdict,M,X,R,[ps=noun]) }.

jadjlist([A|X]) --> jadj(A), jadjlist(X).
jadjlist([]) --> [].

jadj(M) --> [X], { dict(jdict,M,X,R,[ps=adj]) }.

jperiod --> ['。'].

jdict(book, 本, hon, [ps=noun]).
jdict(is, てす, desu, [ps=verb,is,positive]).
jdict(red, 赤, akai, [ps=adj]).
jdict(this, これ, kore,[ps=pronoun]).
jdict(what, 何, nan, [ps=noun]).
jdict(black, kuroi,kuroi,[ps=adj]).
jdict(box, hako,hako, [ps=noun]).
jdict(dictionary, jibiki,jibiki, [ps=noun]).
jdict(farthat, are,are, [ps=pronoun]).
jdict(is, dewa, dewa,[ps=verb,is,negative]).
jdict(not, arimasen, arimasen,[ps=verbneg]).
jdict(pencil, empitsu, empitsu,[ps=noun]).
jdict(that, sono, sone, [ps=adj]).
jdict(that, sore, sore, [ps=pronoun]).
jdict(this, kono, kono, [ps=adj]).

jdict(white, shiroi,shiroi, [ps=adj]).
jdict(blue, aoi, aoi, [ps=adj]).
jdict(school, gakkoo,gakkoo, [ps=noun]).
jdict(university, daigaku, daigaku,[ps=noun]).
jdict(farthat, ano,ano, [ps=adj]).
jdict(letter, tegami, tegami,[ps=noun]).
jdict(window, mado, mado,[ps=noun]).
jdict(big, ookii, ookii,[ps=adj]).
jdict(small, chiisai, chiisai,[ps=adj]).
jdict(desk, tsukue, tsukue,[ps=noun]).
jdict(chair, isu, isu,[ps=noun]).
jdict(old, furui, furui,[ps=adj]).
jdict(new, atarashii, atarashii,[ps=adj]).




