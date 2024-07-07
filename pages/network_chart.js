console.log(chartData)

document.addEventListener('DOMContentLoaded', function() {
    const nodes = new vis.DataSet();
    const edges = new vis.DataSet();

    const nodeExists = new Set(); // To track existing nodes

    chartData.forEach(interaction => {
        const p1 = interaction.protein1;
        const p2 = interaction.protein2;
        const scr = interaction.combined_score;

        // Check and add protein1 if it doesn't exist
        if (!nodeExists.has(p1)) {
            nodes.add({ id: p1, label: p1 });
            nodeExists.add(p1);
        }

        // Check and add protein2 if it doesn't exist
        if (!nodeExists.has(p2)) {
            nodes.add({ id: p2, label: p2 });
            nodeExists.add(p2);
        }

        // Add the edge
        edges.add({ from: p1, to: p2, value: scr });
    });

    const container = document.getElementById('networkChart');
    const data = {
        nodes: nodes,
        edges: edges
    };
    const options = {
        layout: {
            improvedLayout: false // Disable improved layout for better performance
        },
        edges: {
            arrows: {
                to: {
                    enabled: true,
                    scaleFactor: 1
                }
            },
            smooth: {
                type: 'continuous'
            }
        },
        physics: {
            stabilization: false,
            barnesHut: {
                gravitationalConstant: -8000,
                springLength: 250
            }
        }
    };

    new vis.Network(container, data, options);
});
