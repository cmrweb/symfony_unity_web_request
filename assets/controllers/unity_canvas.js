import Buildloader from 'buildloader';

export default class {
    constructor(buildUrl) {
        this.buildUrl = buildUrl;
        this.config = { 
            arguments: [],
            dataUrl: buildUrl + "/Builds.data.br",
            frameworkUrl: buildUrl + "/Builds.framework.js.br",
            codeUrl: buildUrl + "/Builds.wasm.br",
            streamingAssetsUrl: "StreamingAssets",
            companyName: "DefaultCompany",
            productName: "webRTS",
            productVersion: "0.1.0"  
        };
    } 
    render() {
        const canvas = document.querySelector("#unity-canvas");  
        if (/iPhone|iPad|iPod|Android/i.test(navigator.userAgent)) {
          // Mobile device style: fill the whole browser client area with the game canvas:
  
          var meta = document.createElement('meta');
          meta.name = 'viewport';
          meta.content = 'width=device-width, height=device-height, initial-scale=1.0, user-scalable=no, shrink-to-fit=yes';
          document.getElementsByTagName('head')[0].appendChild(meta);
          document.querySelector("#unity-container").className = "unity-mobile";
          canvas.className = "unity-mobile"; 
          this.config.devicePixelRatio = 1; 
        } else {
          // Desktop style: Render the game canvas in a window that can be maximized to fullscreen:
          canvas.style.width = "960px";
          canvas.style.height = "600px";
        }
  
        document.querySelector("#unity-loading-bar").style.display = "block"; 
        const builder = new Buildloader;
        builder.createUnityInstance(canvas, this.config, (progress) => {
            document.querySelector("#unity-progress-bar-full").style.width = 100 * progress + "%";
                }).then((unityInstance) => {
                  document.querySelector("#unity-loading-bar").style.display = "none"; 
                    unityInstance.SetFullscreen(1); 
  
                }).catch((message) => {
                  alert(message);
                }); 
   
    }
}
