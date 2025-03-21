// controla footer
window.addEventListener("load", () => {
    let corpo = document.body.clientHeight;
    let tamTela = window.outerHeight;

    console.log(`
        Carregou !!! altura body: { ${corpo} }
        altura window: { ${tamTela}}
        `);

    if (corpo <= tamTela) {
        let footerMarcao = document.getElementById("footerMarcao");

        footerMarcao.setAttribute("style", "position:fixed;");
        console.log("\n COLOQUEI o  footer colado no fim !");
    } else {
        console.log("\n Não precisou deixar o footer colado no fim !");
    }
});

// cabou o codigorrr
