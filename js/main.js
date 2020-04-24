//put your javascript functions in here.

function YY_checkform() { //v4.71
//copyright (c)1998,2002 Yaromat.com
  var a=YY_checkform.arguments,oo=true,v='',s='',err=false,r,o,at,o1,t,i,j,ma,rx,cd,cm,cy,dte,at;
  for (i=1; i<a.length;i=i+4){
    if (a[i+1].charAt(0)=='#'){r=true; a[i+1]=a[i+1].substring(1);}else{r=false}
    o=MM_findObj(a[i].replace(/\[\d+\]/ig,""));
    o1=MM_findObj(a[i+1].replace(/\[\d+\]/ig,""));
    v=o.value;t=a[i+2];
    if (o.type=='text'||o.type=='password'||o.type=='hidden'){
      if (r&&v.length==0){err=true}
      if (v.length>0)
        if (t==1){ //fromto
          ma=a[i+1].split('_');if(isNaN(v)||v<ma[0]/1||v > ma[1]/1){err=true}
        } else if (t==2){
          rx=new RegExp("^[\\w\.=-]+@[\\w\\.-]+\\.[a-zA-Z]{2,4}$");if(!rx.test(v))err=true;
        } else if (t==3){ // date
          ma=a[i+1].split("#");at=v.match(ma[0]);
          if(at){
            cd=(at[ma[1]])?at[ma[1]]:1;cm=at[ma[2]]-1;cy=at[ma[3]];
            dte=new Date(cy,cm,cd);
            if(dte.getFullYear()!=cy||dte.getDate()!=cd||dte.getMonth()!=cm){err=true};
          }else{err=true}
        } else if (t==4){ // time
          ma=a[i+1].split("#");at=v.match(ma[0]);if(!at){err=true}
        } else if (t==5){ // check this 2
          if(o1.length)o1=o1[a[i+1].replace(/(.*\[)|(\].*)/ig,"")];
          if(!o1.checked){err=true}
        } else if (t==6){ // the same
          if(v!=MM_findObj(a[i+1]).value){err=true}
        }
    } else
    if (!o.type&&o.length>0&&o[0].type=='radio'){
      at = a[i].match(/(.*)\[(\d+)\].*/i);
      o2=(o.length>1)?o[at[2]]:o;
      if (t==1&&o2&&o2.checked&&o1&&o1.value.length/1==0){err=true}
      if (t==2){
        oo=false;
        for(j=0;j<o.length;j++){oo=oo||o[j].checked}
        if(!oo){s+='* '+a[i+3]+'\n'}
      }
    } else if (o.type=='checkbox'){
      if((t==1&&o.checked==false)||(t==2&&o.checked&&o1&&o1.value.length/1==0)){err=true}
    } else if (o.type=='select-one'||o.type=='select-multiple'){
      if(t==1&&o.selectedIndex/1==0){err=true}
    }else if (o.type=='textarea'){
      if(v.length<a[i+1]){err=true}
    }
    if (err){s+='* '+a[i+3]+'\n'; err=false}
  }
  if (s!=''){alert('Please check the information you entered:\t\t\t\t\t\n\n'+s)}
  else
  {
    processSubmit();
  }
  document.MM_returnValue = (s=='');
}

function ok(maxchars)
{
  if(document.form2.Intro.value.length > maxchars)
  {
    alert('You have entered more than 300 characters in the Intro field. Please remove '+(document.form2.Intro.value.length - maxchars)+ ' characters');
    return false;
  }
  else
    return true;
}

function maxlength(element, maxvalue)
{
  var q = eval("document.form2."+element+".value.length");
  var r = q - maxvalue;
  var msg = "Sorry, you have input "+q+" characters into the "+"text area box you just completed. It can return no more than "+maxvalue+" characters to be processed. Please abbreviate "+"your text by at least "+r+" characters";
  if(q > maxvalue) alert(msg);
}


function update()
{
  var old = document.form2.counter.value;
  document.form2.counter.value=document.form2.Intro.value.length;

  if(document.form2.counter.value > limit && old <= limit)
  {
    alert('You have exceeded the limit of 300 characters for this field.');

    if(document.styleSheets)
    {
      document.form2.counter.style.fontWeight = 'bold';
      document.form2.counter.style.color = 'Maroon';
    }
  }
  else if(document.form2.counter.value <= limit && old > limit && document.styleSheets )
  {
    document.form2.counter.style.fontWeight = 'normal';
    document.form2.counter.style.color = '#000000';
  }
}


function move(formO,selectO,to)
{
  var index = selectO.selectedIndex;

  var selectLength  = selectO.length - 1;

  if (index == -1) return false;

  if(to == +1 && index == selectLength)
  {
    alert("Cannot move down anymore!");
    return false;
  }
  else if(to == -1 && index == 0)
  {
    alert("Cannot move up anymore!");
    return false;
  }

  swap(index,index+to,formO,selectO);
  return true;
}

function swap(fIndex,sIndex,formO,selectO)
{
  fText  = selectO.options[fIndex].text;
  fValue = selectO.options[fIndex].value;

  selectO.options[fIndex].text  = selectO.options[sIndex].text;
  selectO.options[fIndex].value = selectO.options[sIndex].value;

  selectO.options[sIndex].text = fText;
  selectO.options[sIndex].value = fValue;

  selectO.options[sIndex].selected = true;

  recalculateOrder(formO,selectO);
}

function recalculateOrder(formO,selectO)
{

  var sep = "";
  var newOrderText = "";
  for (i = 0; i <= selectO.options.length-1; i++)
  {
    //alert(selectO.options[i].value);
    newOrderText += "" + sep + selectO.options[i].text;
    sep = ",";
  }
  formO.SectionOrder.value  = newOrderText;
}


function changeStyle(id, property, value, literal)
{
  function hc(p)
  {
    pa=p.split('-');
    if(pa.length)
    {
      for(var x = 1; x<pa.length; x++)
      {
        pa[x] = pa[x][0].toUpperCase().concat(pa[x].substring(1));
      }
      pn=pa.join('');
    }
    return pn;
  }

  if(el=document.getElementById(id))
  {
    np = hc(property);
    nv = literal ? value : "'" + value + "'";
    eval("el.style." + np + " = " + nv);
  }
}

function FilterDivList(divList, filterList)
{
  filterList.forEach(StripVisibleDivs);

  function StripVisibleDivs(item1)
  {

  }
}

function ShowPageContent(divList,PageView)
{
  switch(PageView) {
    case 'sections' :

      showDivs = ["StartDiv", "NewSectionDiv", "EditSiteSection"];

      break;

    case 'pages' :

      showDivs = ["StartDiv", "AddPage","EditSitePages"];

      break;

    case 'subpages' :

      showDivs = ["StartDiv", "EditSubPages", "EditSubPagesBlurb", "AddSubPages"];
      //ajaxLoader('http://127.0.0.1/shell1/functions/ajaxcall.php?PageCall=showimage','List');

      break;

    case 'addpage' :

      showDivs = ["StartDiv", "AddNewPage"];

      break;

    default :

      showDivs = ["StartDiv", "Recache"];
  }

  divList.forEach(SetHiddenDivs);
  showDivs.forEach(SetVisibleDivs);

  function SetHiddenDivs(item) {
    document.getElementById(item).style.display='none';
  }

  function SetVisibleDivs(item) {
    document.getElementById(item).style.display='block';
  }
}

function ajaxLoader(url,id)
{
  if (document.getElementById)
  {
    var x = new XMLHttpRequest();
  }

  if (x)
  {
    x.onreadystatechange = function()
    {
      if (x.readyState == 4)
      {
        el = document.getElementById(id);
        el.innerHTML = x.responseText;
      }
    }
    x.open("GET", url, true);
    x.send(null);
  }
}

function toggle(divid)
{
  var dv = document.getElementById(divid);
  dv.style.display = (dv.style.display == 'none'? 'block':'none');
}

function toggleDiv(divid)
{
  var dv = document.getElementById(divid);
  dv.style.display = (dv.style.display == 'none'? 'block':'none');
}