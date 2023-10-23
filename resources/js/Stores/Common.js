export let ordered = (nodes) => Object.values(nodes ?? {}).sort((a,b) => a.order - b.order);
