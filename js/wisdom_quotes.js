//var $ = function(id) {return document.getElementById(id);}

/******* http://www.pageresource.com/jscript/jrandom.htm *********/	

function get_random() {
    var randomNumber= Math.floor(Math.random()*57); 		
    return randomNumber;
}

function getaQuote() {
	var quote_of_the_day;
	var whichQuote = get_random();

    var quote=new Array(57);
     quote[0]="A smile confuses an approaching frown.  <br />-Author Unknown";
     quote[1]="People seldom notice old clothes if you wear a big smile.  <br />-Lee Mildon";
     quote[2]="A smile is a curve that sets everything straight.  <br />-Phyllis Diller";   
     quote[3]="Smile. Have you ever noticed how easily puppies make human friends?  Yet all they do is wag their tails and fall over.  <br />-Walter Anderson";
     quote[4]="The world always looks brighter from behind a smile.  <br />-Author Unknown";
	 quote[5]="Start every day with a smile and get it over with.  <br />-W.C. Fields";
	 quote[6]="Before you put on a frown, make absolutely sure there are no smiles available.  <br />-Jim Beggs";
	 quote[7]="A smile is an inexpensive way to change your looks.  <br />-Charles Gordy";
	 quote[8]="Wrinkles should merely indicate where smiles have been.  <br />-Mark Twain";
	 quote[9]="The robbed that smiles, steals something from the thief.  <br />-William Shakespeare, Othello";
	 quote[10]="A smile is the light in the window of your face that tells people you're at home.  <br />-Author Unknown";
	 quote[11]="A smile is the light in the window of your face that tells people you're at home.  <br />-Author Unknown";
	 quote[12]="If you smile when no one else is around, you really mean it.  <br />-Andy Rooney";
	 quote[13]="If you smile at someone, they might smile back.  <br />-Author Unknown";
	 quote[14]="Life is like a mirror, we get the best results when we smile at it.  <br />-Author Unknown";
	 quote[15]="Always remember to be happy because you never know who's falling in love with your smile.  <br />-Author Unknown";
	 quote[16]="Hey, I've got nothing to do today but smile.  <br />-Paul Simon";
	 quote[17]="Everyone smiles in the same language.  <br />-Author Unknown";
	 quote[18]="If you don't have a smile, I'll give you one of mine.  <br />-Author Unknown";
	 quote[19]="If you don't have a smile, I'll give you one of mine.  <br />-Author Unknown";
	 quote[20]="I've never seen a smiling face that was not beautiful.  <br />-Author Unknown";
	 quote[21]="Wear a smile and have friends; wear a scowl and have wrinkles.  <br />-George Eliot";
	 quote[22]="She gave me a smile I could feel in my hip pocket.  <br />-Raymond Chandler";
	 quote[23]="A smile appeared upon her face as if she'd taken it directly from her handbag and pinned it there.  <br />-Loma Chandler";
	 quote[24]="A laugh is a smile that bursts.  <br />-Mary H. Waldrip";
	 quote[25]="Smile — sunshine is good for your teeth. <br />-Author Unknown";
	 quote[26]="Every scowling face also contains the shapes of engaging smiles, just waiting to be released. <br />-Dr. SunWolf";
	 quote[27]="If you don't start out the day with a smile, it's not too late to start practicing for tomorrow. <br />-Author Unknown";
	 quote[28]="Is a smile a question? Or is it the answer? <br />-Lee Smith";
	 quote[29]="Smiling is my favorite exercise. <br />-Author Unknown";
	 quote[30]="Sometimes your joy is the source of your smile, but sometimes your smile can be the source of your joy. <br />-Thich Nhat Hanh";
	 quote[31]="The man who smiles when things go wrong has thought of someone to blame it on. <br />-Robert Bloch";
	 quote[32]="Every smile makes you a day younger. <br />-Chinese Proverb";
	 quote[33]="I like her because she smiles at me and means it. <br />-Terri Guillemets";
	 quote[34]="Wear a smile - one size fits all. <br />-Author Unknown";
	 quote[35]="People are not perfect (except when they smile). <br />-Author Unknown";
	 quote[36]="Every day you spend without a smile, is a lost day.  <br />-Author Unknown";
	 quote[37]="Sometimes it's just enough to smile sincerely.  <br />-Mike Dolan";
	 quote[38]="Everytime you smile at someone, it is an action of love, a gift to that person, a beautiful thing.  <br />-Mother Teresa";
	 quote[39]="A friendly look, a kindly smile, one good act, and life's worthwhile.  <br />-Author Unknown";
	 quote[40]="A kind heart is a fountain of gladness, making everything in its vicinity freshen into smiles.  <br />-Washington Irving";
	 quote[41]="Beauty is power; a smile is its sword.  <br />-Charles Reade";
	 quote[42]="A smile is the universal welcome.  <br />-Max Eastman";
	 quote[43]="Keep smiling - it makes people wonder what you've been up to.  <br />-Author Unknown";
	 quote[44]="You're never fully dressed without a smile.  <br />-Martin Charnin";
	 quote[45]="A smile can brighten the darkest day.  <br />-Author Unknown";
	 quote[46]="Smile, it lets your teeth breathe.  <br />-Author Unknown";
	 quote[47]="It takes seventeen muscles to smile and forty<br />-three to frown.  <br />-Author Unknown";
	 quote[48]="Of all the things you wear, your expression is the most important.  <br />-Janet Lane";
	 quote[49]="The shortest distance between two people is a smile. <br />-Author unknown";
	 quote[50]="All the statistics in the world can't measure the warmth of a smile.  <br />-Chris Hart";
	 quote[51]="If you would like to spoil the day for a grouch, give him a smile.  <br />-Author Unknown";
	 quote[52]="Smile!  It increases your face value.  <br />-Robert Harling";
	 quote[53]="Peace begins with a smile.  <br />-Mother Teresa";
	 quote[54]="A smile is a powerful weapon; you can even break ice with it.  <br />-Author Unknown";
	 quote[55]="Most smiles are started by another smile.  <br />-Author Unknown";
	 quote[56]="A smile is something you can't give away; it always comes back to you.  <br />-Author Unknown";  
  
	var quote_of_the_day = quote[whichQuote];
	document.getElementById("smile_quotes").innerHTML = quote_of_the_day;
 }
 
 setInterval("getaQuote()",60000)
  
window.onload = function() {	
	getaQuote();
}