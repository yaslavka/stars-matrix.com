$(document).ready(function(){
	wow = new WOW(
      {
        animateClass: 'animated',
        offset:       100,
        callback:     function(box) {
          console.log("WOW: animating <" + box.tagName.toLowerCase() + ">")
        }
      }
    );
    wow.init();

		var minMoney 	= [0.001];
		var maxMoney	= [999999];
		// var percent 	= [0.25,6];
		$("#money").val(minMoney[0]);
		function calc(){
			var hourly, daily, monthly;
			money = parseFloat($("#money").val());

			if(money < 0.001 || isNaN(money) == true){
				$("#profitHourly").text("Error!");
				$("#profitDaily").text("Error!");
				$("#profitMonthly").text("Error!");
			} else {
				hourly = money * 0.5 / 100;
				daily = money * 12 /100;
				monthly = money * 12 * 30 / 100
				$("#profitHourly").text(hourly.toFixed(8));
				$("#profitDaily").text(daily.toFixed(8));
				$("#profitMonthly").text(monthly.toFixed(8));
			}

			
				
			// if(days < 1 || isNaN(days) == true){
			// 	days = 1;
			// }
			// id = -1;
			// var length = minMoney.length;
			// var i = 0;
			// do {
			// 	if(minMoney[i] <= money && money <= maxMoney[i]){
			// 		id = i;
			// 		i = i + length;
			// 	}
			// 	i++
			// }
			// while(i < length)
			
			// if(id != -1){
			// 	// profitDaily = money * percent[id]/ 100 ;
			// 	profitDaily = money/ 100 ;
			// 	profitDaily = profitDaily.toFixed(8);
			// 	profitHourly = profitDaily / 24;
			// 	profitHourly = profitHourly.toFixed(8);
			// 	profitWeekly = profitDaily * 7;
			// 	profitWeekly = profitWeekly.toFixed(8);
			// 	profitMonthly = profitDaily * 30;
			// 	profitMonthly = profitMonthly.toFixed(8);
			// 	profitTotal = profitDaily * days;
			// 	profitReturn = profitTotal + money;
			// 	profitTotal = profitTotal.toFixed(8);
			// 	profitReturn = profitReturn.toFixed(8);
			// 	if(money < minMoney[id] || isNaN(money) == true){
			// 		$("#profitHourly").text("Error!");
			// 		$("#profitDaily").text("Error!");
			// 		$("#profitWeekly").text("Error!");
			// 		$("#profitMonthly").text("Error!");
			// 		$("#profitTotal").text("Error!");
			// 		$("#profitReturn").text("Error!");
			// 		if($("#selected_plan").length){
			// 			$("#selected_plan").text("Error!");
			// 			$("#percentHourly").text("Error!");
			// 		}
			// 	} else {
			// 		$("#profitHourly").text(profitHourly + " BTC");
			// 		$("#profitDaily").text(profitDaily + " BTC");
			// 		$("#profitWeekly").text(profitWeekly + " BTC");
			// 		$("#profitMonthly").text(profitMonthly + " BTC");
			// 		$("#profitTotal").text(profitTotal + " BTC");
			// 		$("#profitReturn").text(profitReturn + " BTC");
			// 		if($("#selected_plan").length){
			// 			$("#selected_plan").text($(".plan .boxs:eq(" + id + ") .percent").text());
			// 			$("#percentHourly").text($(".plan .boxs:eq(" + id + ") .text").text());
			// 		}
			// 	}
			// } else {
			// 	$("#profitHourly").text("Error!");
			// 	$("#profitDaily").text("Error!");
			// 	$("#profitWeekly").text("Error!");
			// 	$("#profitMonthly").text("Error!");
			// 	$("#profitTotal").text("Error!");
			// 	$("#profitReturn").text("Error!");
			// 	if($("#selected_plan").length){
			// 			$("#selected_plan").text("Error!");
			// 			$("#percentHourly").text("Error!");
			// 		}
			// }
		}
		if($("#money").length){
			calc();
		}
		$("#money, #days").keyup(function(){
			calc();
		});
});