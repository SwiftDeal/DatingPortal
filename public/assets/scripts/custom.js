
		function loadSlider(sliderId)
		{
			// Gallery carousel
			$("#"+sliderId).carouFredSel({
				width	: "100%",
				auto    : false,
				scroll	: 1,
				swipe: {
					onMouse: true,
					onTouch: true
				},
				prev	: {	
					button	: "#stanga-prev",
					key		: "left"
				},
				next	: { 
					button	: "#dreapta-next",
					key		: "right"
				}
			});
		}
		
    $(window).ready(function(){
			// put here your slider ID
			var sliderID = "gallery-carousel";
			
			//load the slider on page load
			loadSlider(sliderID);
		
		//when someone calls the tab with the slider update the slider sizes
		$(".sliderEvent").live("click", function() {
			$(".mySlider").show();
				loadSlider(sliderID);
			});
    });