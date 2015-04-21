var substringMatcher = function(strs) {
  return function findMatches(q, cb) {
    var matches, substrRegex;

    matches = [];
 
    // regex used to determine if a string contains the substring `q`
    substrRegex = new RegExp(q, 'i');
 
    // iterate through the pool of strings and for any string that
    // contains the substring `q`, add it to the `matches` array
    $.each(strs, function(i, str) {
      if (substrRegex.test(str)) {
        matches.push({ value: str });
      }
    });
 
    cb(matches);
  };
};

var companies = ['4A\'s', 'ABB Group', 'Accenture', 'Burlington Stores', 
'Calumet Specialty Products Partners, L.P.', 'Cardinal Health', 'Emerson', 
'EOG Resources, Inc. (formerly Enron Oil and Gas)' ,'Exelon Corporation', 'FCA Group - Fiat Chrysler Auto Group', 
'Marriott International ', 'Mars Incorporated', 'Moss Adams LLP', 'Oracle', 'SABIC Innovative Plastics', 
'Siemens', 'Sprint', 'TCS (Tata Consultancy Services)', 'TRW Automotive Holdings Corp.'];

var EVPs = ["Attractive/exciting products and services", "Challenging work", "Clear path for advancement", "Client interaction", 
"Competitive base salary", "Competitive benefits", "Control over my number of working hours", "Corporate Social Responsibility", 
"Creative work environment", "Enabling talent to integrate personal Interests into schedule", "Environmental sustainability", 
"Ethical standards", "Fast-growing/entrepreneurial", "Financial strength", "Flexible working conditions", 
"Friendly work environment", "Good reference for future career", "High future earnings", "High level of responsibility", "Innovation", 
"Inspiring management", "Interaction with international clients and colleagues", "Leaders who will support my development", 
"Leadership opportunities", "Market success", "Opportunities for international travel/relocation", "Overtime pay/compensation", 
"Performance-related bonus", "Prestige", "Professional training and development", "Rapid promotion", 
"Recognizing performance (meritocracy)", "Recruiting only the best talent", "Respect for diversity", "Respect for its people", 
"Secure employment", "Sponsorship of future education", "Support for gender equality", "Team-oriented work", "Variety of assignments", 
"Other, please specify: (Fill in)"];

$(function() {
	$('.typeahead').typeahead({
		hint: true,
		highlight: true,
		minLength: 1
	},
	{
		name: 'companies',
		displayKey: 'value',
		source: substringMatcher(companies)
	});
	
	for(i = 0; i < EVPs.length - 1; i++) {
		$('#filterOption-EVP').append("<option value=\""+ EVPs[i] + "\">" + EVPs[i] + "</option>");
	}
	
	$('#filterOption-EVP').append("<option value=\"other\">" + EVPs[i] + "</option>");
	$('#filterOption-EVP').change(function() {
		if($('#filterOption-EVP option:selected').attr('value') === "other") {
			$('#filters').append("<tr id=\"EVPSpec\"><td><h4>EVP specify: </h4></td><td><input type=\"text\" class=\"form-control\"/></td></tr>");
		}
		
		if($('#filterOption-EVP option:selected').attr('value') !== "other") {
			$('#EVPSpec').remove();
		}
	});
	
	for(i = 0; i < companies.length; i++) {
		$('#searchResult').append("<tr><td><a href=\"./companies/" + companies[i] + ".html\"><img src=\"./img/abb.jpg\"/></a></td><td class=\"searchResult-title\"><a href=\"./companies/" + companies[i] + ".html\"><h3>" + companies[i] + "</h3></td></tr>");
	}
});







