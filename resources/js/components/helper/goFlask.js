    let myDiagram

    function init() 
    {
        const $ = go.GraphObject.make;

        myDiagram =
        new go.Diagram("myDiagramDiv",
        {
            "clickCreatingTool.archetypeNodeData": { text: "Paso", color: "white" },
            "commandHandler.archetypeGroupData": { text: "Group", isGroup: true, color: "blue" },
            "undoManager.isEnabled": true,
            isReadOnly: false,
        });

        function makeButton(text, action, visiblePredicate)
        {
            return $("ContextMenuButton",
                   $(go.TextBlock, text),
                   { click: action },
            visiblePredicate ? new go.Binding("visible", "", (o, e) => o.diagram ? visiblePredicate(o, e) : false).ofObject() : {});
        }

        var partContextMenu =
        $("ContextMenu",
            makeButton("Propiedades",
            (e, obj) =>
            {
                var contextmenu = obj.part;
                var part = contextmenu.adornedPart;
                if (part instanceof go.Link) alert(linkInfo(part.data));
                else if (part instanceof go.Group) alert(groupInfo(contextmenu));
                else alert(nodeInfo(part.data));
            }),
            makeButton("Cortar",
            (e, obj) => e.diagram.commandHandler.cutSelection(),
            o => o.diagram.commandHandler.canCutSelection()),
            makeButton("Copiar",
            (e, obj) => e.diagram.commandHandler.copySelection(),
            o => o.diagram.commandHandler.canCopySelection()),
            makeButton("Pegar",
            (e, obj) => e.diagram.commandHandler.pasteSelection(e.diagram.toolManager.contextMenuTool.mouseDownPoint),
            o => o.diagram.commandHandler.canPasteSelection(o.diagram.toolManager.contextMenuTool.mouseDownPoint)),
            makeButton("Eliminar",
            (e, obj) => e.diagram.commandHandler.deleteSelection(),
            o => o.diagram.commandHandler.canDeleteSelection()),
            makeButton("Retroceder",
            (e, obj) => e.diagram.commandHandler.undo(),
            o => o.diagram.commandHandler.canUndo()),
            makeButton("Adelantar",
            (e, obj) => e.diagram.commandHandler.redo(),
            o => o.diagram.commandHandler.canRedo()),
        );

        function nodeInfo(d)
        {
            var str = "Node " + d.key + ": " + d.text + "\n";
            if (d.group)
                str += "member of " + d.group;
            else
                str += "top-level node";
            return str;
        }

        myDiagram.nodeTemplate =
        $(go.Node, "Auto",
            new go.Binding("location", "loc", go.Point.parse).makeTwoWay(go.Point.stringify),
            $(go.Shape, "RoundedRectangle",
            {
                fill: "white",
                portId: "",
                cursor: "pointer",
                fromLinkable: true,
                fromLinkableSelfNode: true,
                fromLinkableDuplicates: true,
                toLinkable: true,
                toLinkableSelfNode: true,
                toLinkableDuplicates: true
            },
            new go.Binding( "fill", "color" )),
            $(go.TextBlock,
            {
                font: "bold 14px sans-serif",
                stroke: '#333',
                margin: 6,
                isMultiline: false,
                editable: true
            },
            new go.Binding("text", "text").makeTwoWay()),
            {
                toolTip:
                $("ToolTip",
                $(go.TextBlock, { margin: 4 },
                    new go.Binding("text", "", nodeInfo))
                ),
            contextMenu: partContextMenu
            }
        );

        function linkInfo(d) 
        {
            return "Link:\nfrom " + d.from + " to " + d.to;
        }

        myDiagram.linkTemplate =
        $(go.Link,
            { 
                toShortLength: 3, 
                relinkableFrom: true, 
                relinkableTo: true,
            },
            $(go.Shape,
            { 
                strokeWidth: 2,
                fill: "black", stroke: "black",
            },
            new go.Binding("stroke", "color")),
            $(go.Shape,
            { toArrow: "Standard", stroke: null },
            new go.Binding("fill", "color")),
            {
            toolTip:
                $("ToolTip",
                $(go.TextBlock, { margin: 4 },
                    new go.Binding("text", "", linkInfo))
                ),
            contextMenu: partContextMenu
            }
        );

        function groupInfo(adornment)
        {
            var g = adornment.adornedPart;
            var mems = g.memberParts.count;
            var links = 0;
            g.memberParts.each(part => {
                if (part instanceof go.Link) links++;
            });
            return "Group " + g.data.key + ": " + g.data.text + "\n" + mems + " members including " + links + " links";
        }

        myDiagram.groupTemplate =
        $(go.Group, "Vertical",
            {
            selectionObjectName: "PANEL",
            ungroupable: true
            },
            $(go.TextBlock,
            {
                font: "bold 19px sans-serif",
                isMultiline: false,
                editable: true
            },
            new go.Binding("text", "text").makeTwoWay(),
            new go.Binding("stroke", "color")),
            $(go.Panel, "Auto",
            { name: "PANEL" },
            $(go.Shape, "Rectangle",
                {
                fill: "rgba(128,128,128,0.2)", stroke: "gray", strokeWidth: 3,
                portId: "", cursor: "pointer",
                fromLinkable: true, fromLinkableSelfNode: true, fromLinkableDuplicates: true,
                toLinkable: true, toLinkableSelfNode: true, toLinkableDuplicates: true
                }),
            $(go.Placeholder, { margin: 10, background: "transparent" })
            ),
            {
            toolTip:
                $("ToolTip",
                $(go.TextBlock, { margin: 4 },
                    new go.Binding("text", "", groupInfo).ofObject())
                ),
            contextMenu: partContextMenu
            }
        );

        function diagramInfo(model)
        {
            return "Modelo:\n" + model.nodeDataArray.length + " nodo(s), " + model.linkDataArray.length + " link(s)";
        }

        myDiagram.toolTip =
        $("ToolTip",
            $(go.TextBlock, { margin: 4 },
            new go.Binding("text", "", diagramInfo))
        );

        myDiagram.contextMenu =
        $("ContextMenu",
            makeButton("Paste",
            (e, obj) => e.diagram.commandHandler.pasteSelection(e.diagram.toolManager.contextMenuTool.mouseDownPoint),
            o => o.diagram.commandHandler.canPasteSelection(o.diagram.toolManager.contextMenuTool.mouseDownPoint)),
            makeButton("Retroceder",
            (e, obj) => e.diagram.commandHandler.undo(),
            o => o.diagram.commandHandler.canUndo()),
            makeButton("Adelantar",
            (e, obj) => e.diagram.commandHandler.redo(),
            o => o.diagram.commandHandler.canRedo())
        );

        var nodeDataArray = [];
        var linkDataArray = [];
        myDiagram.model = new go.GraphLinksModel(nodeDataArray, linkDataArray);
    }

    function setData( nodes, links )
    {
        myDiagram.model = new go.GraphLinksModel( nodes, links );
    }

    function getData()
    {
        return {
            'nodes' : myDiagram.model.Tc,
            'links' : myDiagram.model.md,
        }
    }

    function clearData()
    {
        myDiagram.model = new go.GraphLinksModel( [], [] );
    }

    function disabled( status )
    {
        myDiagram.isReadOnly = status
    }

    export default
    {
        init,
        setData,
        getData,
        clearData,
        disabled,
    }