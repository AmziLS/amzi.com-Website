%:- include('opdefs.pro').

% I made these up because they were missing
inspection(eye_color, [
	choices:: [blue, brown]
	]).
inspection(feel, [
	choices:: [good, bad]
	]).
% ---

inspection(aggravate, [
	choices:: [anger, bowel_movement, cold, cold_drink, eating, emotion, turmoil, heat,
							hot_drink, movement, pressure, rest, stress, warmth]
	]).
inspection(ameliorate, [
	choices:: [bowel_movement, cold, cold_drink, eating, hot_drink, movement, pressure, rest, warmth]
	]).
inspection(appetite, [
	choices:: [craving, good, hungery, normal, poor]
	]).
inspection(aversion, [
	choices:: [cold, heat, wind]
	]).


inspection(chills, [
	choices:: [lots, mild, no, yes]
	]).
inspection(complexion, [
	choices:: [blue, blushing, dark, pale, purple, red, sallow, white, yellow]
	]).
inspection(constitution, [
	choices:: [strong, weak]
	]).
inspection(coughing_sound, [
	choices:: [barking, hacking, loud, persistent, weak, whooping]
	]).


inspection(defecate, [
	choices:: [constipation, diarrhoea, normal]
 	]).
inspection(discharge, [
	choices:: [thick, thin]
	]).
inspection(discharge_color, [
	choices:: [clear, green, yellow]
	]).
inspection(discomfort, [
	choices:: [hypochrondrium]
	]).

inspection(ear, [
	choices:: [tinnitus]
	]).

inspection(emotion, [
	choices:: [angry, happy, stressful, turmoil, sad, upset, worry]
	]).
inspection(energy, [
	choices:: [average, fatigue, high, lassitude, lethargy, low, tired, weak]
	]).


inspection(feelings, [
	choices:: [depression, irritability, palpitation, restlessness, quick_temper]
	]).
inspection(fever, [
	choices:: [high, mild, no]
	]).
inspection(frequent, [
	choices:: [very, not]
	]).
inspection(fullness, [
	choices:: [chest, epigastrium, none]
	]).


inspection(heavy, [
	choices:: [body, head, limbs, none]
	]).


inspection(lips, [
	choices:: [dry, none]
	]).


inspection(location, [
	choices:: [chest, epigastrium, frontal, head, hypochondrium, lower_abdomen, muscle, occipital]
	]).


inspection(mouth, [
	choices:: [dry]
	]).


inspection(nasal, [
	choices:: [discharge, obstruction]
	]).

	
inspection(nose, [
	choices:: [dry]
	]).	
inspection(nose_color, [
	choices:: [normal, red]
	]).


inspection(occurrence, [
	choices:: [frequent, not_often, recurrence]
	]).
inspection(oedema, [
	choices:: [bottom_body, body, face, legs, top_body, stomach]
	]).

% type of pain
inspection(pain, [
	choices:: [ache, boring, burning, cold, colicky, cutting, distending, distressing, 
	emptiness, hemialgia, lurking,
	pantalgia, pulling, pushing, sharp, soreness, spastic, stabbing, throbbing,
	wandering]
	]).
	

inspection(pain(X), [
	choices:: [ache, boring, burning, cold, colicky, cutting, distending, distressing, 
	   emptiness, hemialgia, lurking,
	   pantalgia, pulling, pushing, sharp, soreness, spastic, stabbing, throbbing,
	   wandering]
	]).


inspection(pain_location, [
   choices:: [head, body, extremities]
   ]).
	
inspection(pain_with, [
	choices:: [contraction, dislike_pressure, fixed_location, heaviness,
	preference_cold, preference_pressure, preference_warmth, 
	radiation, spasm, suffocating_feeling, swelling]
	]).

inspection(pulse_contour, [
	choices:: [choppy_pulse, moving_pulse, surging_pulse, slippery_pulse]
	]).
inspection(pulse_depth, [
	choices:: [floating_pulse, hidden_pulse, sinking_pulse]
	]).
inspection(pulse_force, [
	choices:: [empty_pulse, firm_pulse, full_pulse, minute_pulse, soggy_pulse, weak_pulse]
	]).
inspection(pulse_length, [
	choices:: [long_pulse, short_pulse]
	]).
inspection(pulse_rate, [
	choices:: [moderate_pulse, racing_pulse, rapid_pulse, slow_pulse]
	]).
inspection(pulse_rhythm, [
	choices:: [intermittent_pulse, knotted_pulse, skipping_pulse]
	]).
inspection(pulse_tension, [
	choices:: [hollow_pulse, leather_pulse, tight_pulse, scattered_pulse, wiry_pulse]
	]).
inspection(pulse_width, [
	choices:: [big_pulse, fine_pulse]
	]).

inspection(pulse_balance, [
	conditions:: [
		neutral when pulse = normal,
		yin when	pulse = (weak or scattered or hidden),
		yang when pulse = (strong or firm or full) ]
	]).

inspection(respiratory, [
	choices:: [dyspnea, rebellious, sob, sighing, weak, wheezing]
	]).

inspection(sensation, [
	choices:: [dizziness, fullness, heat, heaviness, nausea, numbness, palpitation, stiffness, stuffiness, 
	tightness, tingling]
	]).

inspection(affected_head, [
	choices:: [ear, eye, frontal, gum, head, mouth, neck, nose, occipital, tooth, throat]
	]).
inspection(affected_extremity, [
	choices:: [ankle, arm, elbow, fingure, foot, forearm, hand, joint, knee, leg, limb, lower_limb, palm, upper_arm, 
					upper_limb, sole, thigh, toe, wrist]
	]).	
inspection(affected_body, [
	choices:: [back, body, muscle, skin, spine]
	]).	
inspection(affected_genitalia, [
	choices:: [penis, scrotum, testes, uterus, vagina]
	]).
inspection(affected_lower_body, [
	choices:: [abdomen, coccyx, epigastrium, hypochondrium, lower_abdomen, lower_back, hip, sacrum]
	]).
inspection(affected_upper_body, [
	choices:: [shoulder, chest, rib, scapula]
	]).
inspection(affected_internal, [
	choices:: [brain, bone, gall, heart, kidney, large_intestine, liver, lung, small_intestine, spleen, stomach, bladder]
	]).

inspection(sleep, [
	choices:: [insomnia]
	]).
inspection(speech, [
	choices:: [delirious, dislike, feeble, hesitation, incoherent,
		laughing, muttering, reluctance, slurred, talk_sleep, talkative]
	]).
inspection(sputum, [
	choices:: [bloody, dry, sticky, thick, thin, watery]
	]).
inspection(sputum_amount, [
	choices:: [little, moderate, none, profuse, scanty]
	]).
inspection(sputum_color, [
	choices:: [clear, green, red, white, yellow]
	]).
inspection(sputum_expectorate, [
	choices:: [difficult, easy]
	]).
	
inspection(stage, [
	choices:: [acute, chronic]
	]).
inspection(stiffness, [
	choices:: [body, muscle, neck]
	]).
inspection(stuffiness, [
	choices:: [chest, epigastrium]
	]).

inspection(stool, [
	choices:: [dry, bloody, loose, mucus, undigested_food, sticky]
	]).
inspection(stool_color, [
	choices:: [black, dark, dark_yellow, green, qing, light_brown,
		pale, pale_yellow, red, dark_very]
	]).
inspection(stool_shape, [
	choices:: [long_thin, normal, pellets]
	]).

inspection(sweat, [
	choices:: [mild, no, profuse, spontaneous]
	]).
inspection(sweat_area, [
	choices:: [axillae, chest, feet, hands, head, palm]
	]).

inspection(taste, [
	choices:: [acrid, bitter, blend, pungent, salty, sour, sweet]
	]).
inspection(temperature, [
	choices:: [cold, cool, hot, warm]
	]).  
inspection(tension, [
	choices:: [hypochrondria]
	]).
inspection(thirst, [
	choices:: [little, no, no_drink, very]
	]).
inspection(throat, [
	choices:: [congested, dry, itchy, scratchy, sore, ticklish]
	]).
inspection(time_occur, [
	choices:: [afternoon, day, evening, morning, night]
	]).

inspection(tongue_body, [
	choices:: [bleak, fissured, spotted, tender, tough]
	]).
inspection(tongue_color, [
	choices:: [blue, brown, crimson, pale, pink, purple, red, red_tip]
	]).
inspection(tongue_coat, [
	choices:: [none, peeled, root, snow, thick, thin, unroot]
	]).
inspection(tongue_coat_color, [
	choices:: [black, dark, grey, light, white, yellow]
	]).
inspection(tongue_coat_distribution, [
	choices:: [center, full, partial, sides]
	]).
inspection(tongue_coat_texture, [
	choices:: [dry, curdy, exfoliative, greasy, mouldy, moist, putrid, rough, slippery, sticky, wet]
	]).
inspection(tongue_move_state, [
	choices:: [flaccid, deviated, protruding, retracted, trembling, stiff]
	]).
inspection(tongue_shape, [
	choices:: [big, double_tongue, fat, long, short, swollen, small, thin, thorny, toothmarked]
	]).
inspection(tongue_spirit, [
	choices:: [lustrous, normal, withered]
	]).
inspection(injury, [
	choices:: [bruise, trauma]
	]).

inspection(urination, [
	choices:: [difficult, frequent, urgent]
	]).
inspection(urine_amount, [
	choices:: [profuse, scanty]
	]).
inspection(urine_color, [
	choices:: [bloody, clear, dark, mucus, pale, red, turbid, yellow]
	]).

inspection(voice, [
	choices:: [crying, groaning, hoarse, loud, muffled, nasal, rattling, strong, stuttering, weak]
	]).
inspection(vomit, [
	choices:: [yes, no]
	]).

inspection(worse, [
	choices:: [after_meal, before_meal, exertion, night, morning]
	]).

inspection(complaint, [
	choices:: [cough, pain]
	]).