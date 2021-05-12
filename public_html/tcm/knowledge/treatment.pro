% treatment.pro
%

%:- include('opdefs.pro').

% treatment principles
% patterns of cough
treatment_principle(wind_cold_cough, [
	pattern:: wind_cold_cough,
	conditions:: complaint = cough
   ]).

treatment_principle(wind_heat_cough, [
	pattern:: wind_heat,
	conditions:: complaint = cough
   ]).

treatment_principle(warm_dryness_cough, [
	pattern:: warm_dryness,
	conditions:: complaint = cough
   ]).

treatment_principle(cool_dryness_cough, [
	pattern:: cool_dryness,
	conditions:: complaint = cough
   ]).

treatment_principle(lung_heat_cough, [
	pattern:: lung_heat,
	conditions:: complaint = cough
   ]).

treatment_principle(phlegm_damp_cough, [
	pattern:: phlegm_damp,
	conditions:: complaint = cough
   ]).
	
treatment_principle(phlegm_heat_cough, [
	pattern:: phlegm_heat,
	conditions:: complaint = cough
   ]).

treatment_principle(liver_fire_invading_lungs_cough, [
	pattern:: liver_fire_invading_lungs,
	conditions:: complaint = cough
   ]).

treatment_principle(lung_yin_deficiency_cough, [
	pattern:: lung_yin_deficiency,
	conditions:: complaint = cough
   ]).

treatment_principle(lung_qi_deficiency_cough, [
	pattern:: lung_qi_deficiency,
	conditions:: complaint = cough
   ]).

treatment_principle(spleen_kidney_yang_deficiency_cough, [
	pattern:: spleen_kidney_yang_deficiency,
	conditions:: complaint = cough
   ]).

treatment_principle(blood_stagnation_cough, [
	pattern:: blood_stagnation_deficiency,
	conditions:: complaint = cough
   ]).
% end of cough

% patterns of pain
treatment_principle(wind_cold_pain, [
	pattern:: wind_cold,
	conditions:: complain = pain
	]).
	
treatment_principle(wind_damp_pain, [
	pattern:: wind_damp,
	conditions:: complaint = pain
	]).
	
treatment_principle(damp_heat_pain, [
	pattern:: damp_heat,
	conditions:: complaint = pain
	]).

treatment_principle(liver_qi_stagnation_pain, [
	pattern:: invasion_liver_qi,
	conditions:: complaint = pain
	]).

treatment_principle(blood_stagnation_pain, [
	pattern:: blood_stagnation,
	conditions:: complaint = pain
	]).

treatment_principle(qi_blood_deficiency_pain, [
	pattern:: qi_blood_deficiency,
	conditions:: complaint = pain
	]).
	
treatment_principle(kidney_yin_deficiency_pain, [
	pattern:: kidney_yin_deficiency,
	conditions:: complaint = pain
	]).
		
treatment_principle(kidney_yang_deficiency_pain, [
	pattern:: kidney_yang_deficiency,
	conditions:: complaint = pain
	]).
% end of pain