$(function() {

	$("table.chart-pie").each(function() {
        $(this).graphTable({
            series: 'columns',
            position: 'replace',
			width : '100%',
            height: '325px'
        }, {
		series: {
            pie: { 
                show: true,
				innerRadius: 0.45,
                radius: 1,
				tilt: 1,
                label: {
                    show: true,
                    radius: 1,
                    formatter: function(label, series){
						var d = series.data.toString().split(',');
                        return '<div id="tooltipPie">'+label+': '+d[1]+'</div>';
                    },
                    background: { opacity: 0 }
                }
            }
        },
        legend: {
            show: false
        },
			grid: {
				hoverable: false,
				autoHighlight: true
			}
        });
    });
	
});
