import{u as E}from"./auth-81eecb93.js";import{_ as h,k as C,r as _,a as K,w as n,j as t,o as S,b as a,g as i,f as j,a3 as A}from"./_plugin-vue_export-helper-da3472a7.js";const B={name:"Login",setup(){const c=E(),e=C({email:"",password:""}),s=_({}),o=_(!1);return{form:e,validationErrors:s,processing:o,login:async()=>{o.value=!0,await c.login(e).catch(({response:l})=>{l.status===422?s.value=l.data.errors:s.value={}}).finally(()=>{o.value=!1})}}}};function F(c,e,s,o,m,l){const u=t("v-toolbar-title"),f=t("v-toolbar"),d=t("v-text-field"),v=t("v-form"),p=t("v-card-text"),g=t("router-link"),w=t("v-spacer"),b=t("v-btn"),x=t("v-card-actions"),y=t("v-card"),k=t("v-sheet"),V=t("v-container");return S(),K(V,{fluid:"",class:"fill-height justify-center"},{default:n(()=>[a(k,{width:"400",class:"mx-auto"},{default:n(()=>[a(y,null,{default:n(()=>[a(f,null,{default:n(()=>[a(u,{class:"text-grey-darken-3"},{default:n(()=>[i("Авторизация")]),_:1})]),_:1}),a(p,null,{default:n(()=>[a(v,{onSubmit:e[4]||(e[4]=j(()=>{},["prevent"])),onKeypress:A(o.login,["enter"])},{default:n(()=>[a(d,{"bg-color":"white",modelValue:o.form.email,"onUpdate:modelValue":e[0]||(e[0]=r=>o.form.email=r),type:"email",label:"Email",autofocus:"","error-messages":o.validationErrors.email,onFocus:e[1]||(e[1]=r=>o.validationErrors.email=[])},null,8,["modelValue","error-messages"]),a(d,{"bg-color":"white",modelValue:o.form.password,"onUpdate:modelValue":e[2]||(e[2]=r=>o.form.password=r),type:"password",label:"Password","error-messages":o.validationErrors.password,onFocus:e[3]||(e[3]=r=>o.validationErrors.password=[])},null,8,["modelValue","error-messages"])]),_:1},8,["onKeypress"])]),_:1}),a(x,null,{default:n(()=>[a(g,{to:{name:"register"},class:"text-blue"},{default:n(()=>[i("Зарегистрироваться")]),_:1}),a(w),a(b,{variant:"outlined",color:"blue",onClick:o.login},{default:n(()=>[i("Войти")]),_:1},8,["onClick"])]),_:1})]),_:1})]),_:1})]),_:1})}const U=h(B,[["render",F]]);export{U as default};