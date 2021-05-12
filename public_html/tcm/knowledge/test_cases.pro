%:- include('opdefs.pro').

% Test Cases


case(wind_cold_cough_1, [
	inputs:: [
	  	complaint = cough,
	  	stage = acute,
  		occurrence = frequent,
  		coughing_sound = loud,
  		sputum_amount = [moderate, thin, watery],
  		sputum_color = clear,
		chills = lots,
		fever = mild,
		pain_location = occipital,
		stiffness = neck,
		sweat = none,
		nasal = obstruction,
		respiratory = dyspnea,
		tongue_spirit = normal,
		tongue_coat = thin,
		tongue_coat_color = white,
		pulse_depth = floating_pulse
		],
	output:: wind_cold_cough
	]).
	
case(wind_cold_cough_2, [
	inputs:: [
	  	complaint = cough,
	  	stage = acute,
  		occurrence = frequent,
  		coughing_sound = loud,
  		sputum_amount = [moderate, thin, watery],
  		sputum_color = clear,
		chills = lots,
		fever = mild,
		pain_location = occipital,
		stiffness = neck,
		sweat = none,
		nasal = discharge,
		respiratory = dyspnea,
		tongue_spirit = normal,
		tongue_coat = thin,
		tongue_coat_color = white,
		pulse_depth = floating_pulse
		],
	output:: wind_cold_cough
	]).

case(blood_stagnation_pain2, [
   inputs:: [
      complaint = cough,
      pain(body) = [sharp, stabbing],
      thirst = no_drink,
      time_occur = night,
      tongue_color = purple,
      tongue_coat_color = white,
      pulse_contour = choppy_pulse,
      pulse_depth = sinking_pulse
      ],
   output:: blodd_stagnation2
   ]).
