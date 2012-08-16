
function buildGraph(sales, count, obj)
{

    $.plot($(obj),
        [
            { data: count, label: "Products Sold/Month" },
            { data: sales, label: "Sales/Month (" + currency + ")", yaxis: 2 }
        ],
        { 
            xaxes: [ { mode: 'time' } ],
            yaxes: [ { min: 0 }, { alignTicksWithAxis: 1, position: 'right', tickFormatter: currencyFormatter } ],
            legend: { position: 'sw' }
        }
    );

}

function currencyFormatter(v, axis) {
    return currency + v.toFixed(2);
}