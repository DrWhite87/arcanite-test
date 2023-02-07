import{_ as C,c as b,k as F,r as v,a as S,w as a,j as t,o as U,b as o,g as _,f as P,a4 as j}from"./_plugin-vue_export-helper-da3472a7.js";import{u as B}from"./payments-3f6f873e.js";import{e as N}from"./auth-c8cb1dd9.js";const D={name:"PaymentsEdit",setup(){const l=B(),e=b(()=>Object.keys(l.currency).map(s=>({value:s,label:l.currency[s]}))),f=b(()=>l.users),r=N();l.create();const d=F({user_id:"",requisites:"",amount:"",currency:""}),i=v({}),m=v(!1),u=v(!1);return{form:d,validationErrors:i,processing:m,currency:e,users:f,updated:u,store:async()=>{m.value=!0,await l.store(d).then(({data:s})=>{i.value={},r.push({name:"payments.index"})}).catch(({response:s})=>{s.status===422?i.value=s.data.errors:i.value={}}).finally(()=>{m.value=!1})}}}};function M(l,e,f,r,d,i){const m=t("v-toolbar-title"),u=t("v-toolbar"),c=t("v-select"),s=t("v-textarea"),g=t("v-text-field"),E=t("v-form"),x=t("v-card-text"),y=t("v-btn"),V=t("v-spacer"),p=t("v-card-actions"),k=t("v-card"),q=t("v-sheet"),w=t("v-container");return U(),S(w,{fluid:""},{default:a(()=>[o(q,{width:"800",class:"mx-auto"},{default:a(()=>[o(k,null,{default:a(()=>[o(u,null,{default:a(()=>[o(m,{class:"text-grey-darken-3"},{default:a(()=>[_("Редактирование выплаты")]),_:1})]),_:1}),o(x,null,{default:a(()=>[o(E,{onSubmit:e[8]||(e[8]=P(()=>{},["prevent"]))},{default:a(()=>[o(c,{modelValue:r.form.user_id,"onUpdate:modelValue":e[0]||(e[0]=n=>r.form.user_id=n),items:r.users,label:"Логин","item-title":"name","item-value":"id",error:!!r.validationErrors.user_id&&r.validationErrors.user_id.length,"error-messages":r.validationErrors.user_id,onFocus:e[1]||(e[1]=n=>r.validationErrors.user_id=[])},null,8,["modelValue","items","error","error-messages"]),o(s,{"bg-color":"white",modelValue:r.form.requisites,"onUpdate:modelValue":e[2]||(e[2]=n=>r.form.requisites=n),label:"Реквизиты",error:!!r.validationErrors.requisites&&r.validationErrors.requisites.length,"error-messages":r.validationErrors.requisites,onFocus:e[3]||(e[3]=n=>r.validationErrors.requisites=[])},null,8,["modelValue","error","error-messages"]),o(g,{"bg-color":"white",modelValue:r.form.amount,"onUpdate:modelValue":e[4]||(e[4]=n=>r.form.amount=n),label:"Сумма",error:!!r.validationErrors.amount&&r.validationErrors.amount.length,"error-messages":r.validationErrors.amount,onFocus:e[5]||(e[5]=n=>r.validationErrors.amount=[])},null,8,["modelValue","error","error-messages"]),o(c,{modelValue:r.form.currency,"onUpdate:modelValue":e[6]||(e[6]=n=>r.form.currency=n),items:r.currency,label:"Валюта","item-title":"label","item-value":"value",error:!!r.validationErrors.currency&&r.validationErrors.currency.length,"error-messages":r.validationErrors.currency,onFocus:e[7]||(e[7]=n=>r.validationErrors.currency=[])},null,8,["modelValue","items","error","error-messages"])]),_:1})]),_:1}),o(p,null,{default:a(()=>[o(y,{variant:"outlined",color:"black",onClick:e[9]||(e[9]=n=>l.$router.push({name:"payments.index"}))},{default:a(()=>[_("Назад")]),_:1}),o(V),o(y,{variant:"outlined",color:"blue",onClick:r.store},{default:a(()=>[_(j(r.processing?"Подождите":"Сохранить"),1)]),_:1},8,["onClick"])]),_:1})]),_:1})]),_:1})]),_:1})}const z=C(D,[["render",M]]);export{z as default};
