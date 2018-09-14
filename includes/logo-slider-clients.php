<script>
    $(window).load(function() {
        $(function() {
            $('#foo2').carouFredSel({
				auto: false,
				responsive: true,
				width: '100%',
				scroll: 1,
                prev: '#prev2',
				next: '#next2',
				items: {
					height: 'auto',
					width:225,
					visible: {
						min: 1,
						max: 4
					}
				},
				mousewheel: true,
				swipe: {
					onMouse: true,
					onTouch: true
				}
			});
		});  	 				
      });
</script>
