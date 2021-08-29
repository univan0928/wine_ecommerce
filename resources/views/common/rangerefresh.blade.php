
    <div class="col-rt-12">
        <div class="Scriptcontent">
            <!-- Range Slider HTML -->
            <div slider id="slider-distance">
                <div>
                    <div inverse-left style="width:0%;"></div>
                    <div inverse-right style="width:0%;"></div>
                    <div range style="left:0%;right:0%;"></div>
                    <span thumb style="left:0%;"></span>
                    <span thumb style="left:100%;"></span>
                    <div sign style="left:0%;">
                        <span id="value">0</span><span>円</span>
                    </div>
                    <div sign style="left:100%;">
                        <span id="value">100000</span><span>円</span>
                    </div>
                </div>
                <input id = "range_price_start" name="range_price_start" type="range" tabindex="0" value="0" max="100" min="0" step="1" oninput="
                                        this.value=Math.min(this.value,this.parentNode.childNodes[5].value-1);
                                        var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
                                        var children = this.parentNode.childNodes[1].childNodes;
                                        children[1].style.width=value+'%';
                                        children[5].style.left=value+'%';
                                        children[7].style.left=value+'%';children[11].style.left=value+'%';
                                        children[11].childNodes[1].innerHTML=this.value*1000;
                                        " />

                <input id ="range_price_end" name = "range_price_end" type="range" tabindex="0" value="100" max="100" min="0" step="1" oninput="
                                        this.value=Math.max(this.value,this.parentNode.childNodes[3].value-(-1));
                                        var value=(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.value)-(100/(parseInt(this.max)-parseInt(this.min)))*parseInt(this.min);
                                        var children = this.parentNode.childNodes[1].childNodes;
                                        children[3].style.width=(100-value)+'%';
                                        children[5].style.right=(100-value)+'%';
                                        children[9].style.left=value+'%';children[13].style.left=value+'%';
                                        children[13].childNodes[1].innerHTML=this.value*1000;

                                        " />
            </div>
            <!-- End Range Slider HTML -->
        </div>
    </div>
