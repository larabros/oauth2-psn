First makes a request to get an SSO cookie:

POST /2.0/ssocookie HTTP/1.1
Host: auth.api.sonyentertainmentnetwork.com
Accept-Language: en-gb
User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 9_2_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Mobile/13D15 PlayStation App/3.20.2/en-GB/en-GB
Accept: */*
Referer: https://id.sonyentertainmentnetwork.com/signin/?response_type=code&state=Fkpn0XsfeJMbf8H4i75C0dOIjIA&service_entity=urn:service-entity:psn&duid=0000000d00040080385B97FEDAAD42A28916D9082210BBDD&device_profile=mobile&redirect_uri=com.playstation.PlayStationApp://redirect&app_context=inapp_ios&smcid=psapp:signin&client_id=4db3729d-4591-457a-807a-1cf01e60c3ac&client_secret=criemouwIuVoa4iU&service_logo=ps&ui=pr&device_base_font_size=10&support_scheme=sneiprls&scope=psn:sceapp,user:account.get,user:account.settings.privacy.get,user:account.settings.privacy.update,user:account.realName.get,user:account.realName.update,kamaji:get_account_hash,kamaji:ugc:distributor,oauth:manage_device_usercodes&error=login_required&error_code=4165&error_description=User+is+not+authenticated
Content-Type: application/x-www-form-urlencoded
Connection: keep-alive
Proxy-Connection: keep-alive
Cookie: JSESSIONID=3DA615B8EC9C0C28CF9A291F98A6FB75.lvp-p1-npversat49-4709; s_cc=true; s_fid=2BB214FFEDC9A6B5-2F2CB87275E626F5; s_prepagename=ios%3Apdr%3Asignin%3Aentrance%20signin; s_sq=%5B%5BB%5D%5D
Content-Length: 143
Origin: https://id.sonyentertainmentnetwork.com
Accept-Encoding: gzip, deflate

authentication_type=password&username=niteshade.hassan%40gmail.com&password=T2%25kZY52%242!2Yu5E&client_id=71a7beb8-f21a-47d9-a604-2e71bee24fe0

And gets the response:

HTTP/1.1 200 OK
Server: Apache
Access-Control-Allow-Origin: https://id.sonyentertainmentnetwork.com
Access-Control-Allow-Credentials: true
Access-Control-Expose-Headers: Access-Control-Allow-Origin,X-Request-ID,Access-Control-Allow-Credentials,X-NPSSO-TOKEN,Content-Length,X-SNP-REJECT,X-Np-Console-Token,X-NP-GRANT-CODE,Location
x-wily-info: Clear guid=879001000AD3356514E4CC0FB0C9CE85
x-wily-servlet: Encrypt1 hR/KG2GOR16aRfvv3/q1AYmRuJmOee/Y5s5imluJ6HPZPHI/6MY8f3YcYCYHUfK9zSCSozCJbOlOnOe8e4ZK7Ekf6UfnlPgROsyFTGNoIQV1tTTp50Ge98wBtnDTps6QmG093NlfIGfxMmK4ntvFMEc2dgwqSuOPz02tVXlcS+ahzLT9rqsI2C67B0b2XBEP
Cache-Control: no-cache, no-store, max-age=0, must-revalidate
Pragma: no-cache
Expires: 0
Content-Type: application/json;charset=UTF-8
Content-Length: 76
Date: Fri, 18 Mar 2016 02:31:15 GMT
Connection: close
Set-Cookie: npsso=2PTQnPB1YE4ghBn73ygiTZ6K3rozcR4ykkCiwJHvDYU094FGaB10UusPK3U2NPY2; expires=Tue, 17-May-2016 02:31:15 GMT; path=/; secure

{"npsso":"2PTQnPB1YE4ghBn73ygiTZ6K3rozcR4ykkCiwJHvDYU094FGaB10UusPK3U2NPY2"}

Then a request to get available options?:

OPTIONS /2.0/oauth/authorizeCheck HTTP/1.1
Host: auth.api.sonyentertainmentnetwork.com
Accept-Language: en-gb
User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 9_2_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Mobile/13D15 PlayStation App/3.20.2/en-GB/en-GB
Accept: */*
Referer: https://id.sonyentertainmentnetwork.com/signin/?response_type=code&state=Fkpn0XsfeJMbf8H4i75C0dOIjIA&service_entity=urn:service-entity:psn&duid=0000000d00040080385B97FEDAAD42A28916D9082210BBDD&device_profile=mobile&redirect_uri=com.playstation.PlayStationApp://redirect&app_context=inapp_ios&smcid=psapp:signin&client_id=4db3729d-4591-457a-807a-1cf01e60c3ac&client_secret=criemouwIuVoa4iU&service_logo=ps&ui=pr&device_base_font_size=10&support_scheme=sneiprls&scope=psn:sceapp,user:account.get,user:account.settings.privacy.get,user:account.settings.privacy.update,user:account.realName.get,user:account.realName.update,kamaji:get_account_hash,kamaji:ugc:distributor,oauth:manage_device_usercodes&error=login_required&error_code=4165&error_description=User+is+not+authenticated
Access-Control-Request-Method: POST
Connection: keep-alive
Access-Control-Request-Headers: origin, content-type
Proxy-Connection: keep-alive
Content-Length: 0
Origin: https://id.sonyentertainmentnetwork.com
Accept-Encoding: gzip, deflate

Which responds:

HTTP/1.1 200 OK
Server: Apache
Access-Control-Allow-Origin: https://id.sonyentertainmentnetwork.com
Access-Control-Allow-Credentials: true
Access-Control-Max-Age: 1800
Access-Control-Allow-Methods: POST
Access-Control-Allow-Headers: x-request-id,x-npsso-token,duid,origin,access-control-request-method,accept,x-snp-reject,authorization,x-np-console-token,x-requested-with,access-control-request-headers,content-type,x-np-grant-code
Content-Length: 0
Content-Type: text/plain; charset=UTF-8
Date: Fri, 18 Mar 2016 02:31:15 GMT
Connection: close


Then a POST to the same URL:

POST /2.0/oauth/authorizeCheck HTTP/1.1
Host: auth.api.sonyentertainmentnetwork.com
Accept-Language: en-gb
User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 9_2_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Mobile/13D15 PlayStation App/3.20.2/en-GB/en-GB
Accept: */*
Referer: https://id.sonyentertainmentnetwork.com/signin/?response_type=code&state=Fkpn0XsfeJMbf8H4i75C0dOIjIA&service_entity=urn:service-entity:psn&duid=0000000d00040080385B97FEDAAD42A28916D9082210BBDD&device_profile=mobile&redirect_uri=com.playstation.PlayStationApp://redirect&app_context=inapp_ios&smcid=psapp:signin&client_id=4db3729d-4591-457a-807a-1cf01e60c3ac&client_secret=criemouwIuVoa4iU&service_logo=ps&ui=pr&device_base_font_size=10&support_scheme=sneiprls&scope=psn:sceapp,user:account.get,user:account.settings.privacy.get,user:account.settings.privacy.update,user:account.realName.get,user:account.realName.update,kamaji:get_account_hash,kamaji:ugc:distributor,oauth:manage_device_usercodes&error=login_required&error_code=4165&error_description=User+is+not+authenticated
Content-Type: application/json; charset=UTF-8
Connection: keep-alive
Proxy-Connection: keep-alive
Cookie: JSESSIONID=3DA615B8EC9C0C28CF9A291F98A6FB75.lvp-p1-npversat49-4709; npsso=2PTQnPB1YE4ghBn73ygiTZ6K3rozcR4ykkCiwJHvDYU094FGaB10UusPK3U2NPY2; s_cc=true; s_fid=2BB214FFEDC9A6B5-2F2CB87275E626F5; s_prepagename=ios%3Apdr%3Asignin%3Aentrance%20signin; s_sq=%5B%5BB%5D%5D
Content-Length: 410
Origin: https://id.sonyentertainmentnetwork.com
Accept-Encoding: gzip, deflate

{"npsso":"2PTQnPB1YE4ghBn73ygiTZ6K3rozcR4ykkCiwJHvDYU094FGaB10UusPK3U2NPY2","client_id":"4db3729d-4591-457a-807a-1cf01e60c3ac","scope":"psn:sceapp,user:account.get,user:account.settings.privacy.get,user:account.settings.privacy.update,user:account.realName.get,user:account.realName.update,kamaji:get_account_hash,kamaji:ugc:distributor,oauth:manage_device_usercodes","service_entity":"urn:service-entity:psn"}

Which responds:

HTTP/1.1 204 No Content
Server: Apache
Access-Control-Allow-Origin: https://id.sonyentertainmentnetwork.com
Access-Control-Allow-Credentials: true
Access-Control-Expose-Headers: Access-Control-Allow-Origin,X-Request-ID,Access-Control-Allow-Credentials,X-NPSSO-TOKEN,Content-Length,X-SNP-REJECT,X-Np-Console-Token,X-NP-GRANT-CODE,Location
x-wily-info: Clear guid=8790052C0AD3356514E4CC0F8A4B4BE5
x-wily-servlet: Encrypt1 hR/KG2GOR16aRfvv3/q1AYmRuJmOee/Y5s5imluJ6HPZPHI/6MY8f3YcYCYHUfK9zSCSozCJbOlOnOe8e4ZK7Ekf6UfnlPgROsyFTGNoIQXfQ8cbIo7x5IbUeT5kkDfDGrcQbLeORtwH9c4xoqW+VUS6jitpn0wBdSS6ddcprdS/BR7SsPZk/Rq9CXEsrz8BYFiV/bQpDSTGkcnOAK0eqw==
Cache-Control: no-cache, no-store, max-age=0, must-revalidate
Pragma: no-cache
Expires: 0
Content-Length: 0
Content-Type: text/plain; charset=UTF-8
Date: Fri, 18 Mar 2016 02:31:16 GMT
Connection: close

Finally, the request to authorize the code:

GET /2.0/oauth/authorize?state=Fkpn0XsfeJMbf8H4i75C0dOIjIA&duid=0000000d00040080385B97FEDAAD42A28916D9082210BBDD&client_secret=criemouwIuVoa4iU&ui=pr&app_context=inapp_ios&client_id=4db3729d-4591-457a-807a-1cf01e60c3ac&device_base_font_size=10&device_profile=mobile&redirect_uri=com.playstation.PlayStationApp://redirect&response_type=code&scope=psn:sceapp,user:account.get,user:account.settings.privacy.get,user:account.settings.privacy.update,user:account.realName.get,user:account.realName.update,kamaji:get_account_hash,kamaji:ugc:distributor,oauth:manage_device_usercodes&service_entity=urn:service-entity:psn&service_logo=ps&support_scheme=sneiprls&smcid=psapp:signin HTTP/1.1
Host: auth.api.sonyentertainmentnetwork.com
Referer: https://id.sonyentertainmentnetwork.com/signin/?response_type=code&state=Fkpn0XsfeJMbf8H4i75C0dOIjIA&service_entity=urn:service-entity:psn&duid=0000000d00040080385B97FEDAAD42A28916D9082210BBDD&device_profile=mobile&redirect_uri=com.playstation.PlayStationApp://redirect&app_context=inapp_ios&smcid=psapp:signin&client_id=4db3729d-4591-457a-807a-1cf01e60c3ac&client_secret=criemouwIuVoa4iU&service_logo=ps&ui=pr&device_base_font_size=10&support_scheme=sneiprls&scope=psn:sceapp,user:account.get,user:account.settings.privacy.get,user:account.settings.privacy.update,user:account.realName.get,user:account.realName.update,kamaji:get_account_hash,kamaji:ugc:distributor,oauth:manage_device_usercodes&error=login_required&error_code=4165&error_description=User+is+not+authenticated
Proxy-Connection: keep-alive
Accept-Encoding: gzip, deflate
Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8
Cookie: JSESSIONID=3DA615B8EC9C0C28CF9A291F98A6FB75.lvp-p1-npversat49-4709; npsso=2PTQnPB1YE4ghBn73ygiTZ6K3rozcR4ykkCiwJHvDYU094FGaB10UusPK3U2NPY2; s_cc=true; s_fid=2BB214FFEDC9A6B5-2F2CB87275E626F5; s_prepagename=ios%3Apdr%3Asignin%3Aentrance%20signin; s_sq=%5B%5BB%5D%5D
Accept-Language: en-gb
Connection: keep-alive
User-Agent: Mozilla/5.0 (iPhone; CPU iPhone OS 9_2_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Mobile/13D15 PlayStation App/3.20.2/en-GB/en-GB


And the response:

HTTP/1.1 302 Moved Temporarily
Location: com.playstation.PlayStationApp://redirect?code=C2eyDV&state=Fkpn0XsfeJMbf8H4i75C0dOIjIA
Server: Apache
p3p: CP="This site does not have a P3P policy."
x-wily-info: Clear guid=879007680AD3356514E4CC0F432CB16E
x-wily-servlet: Encrypt1 hR/KG2GOR16aRfvv3/q1AYmRuJmOee/Y5s5imluJ6HPZPHI/6MY8f3YcYCYHUfK9zSCSozCJbOlOnOe8e4ZK7Ekf6UfnlPgROsyFTGNoIQV1tTTp50Ge98wBtnDTps6QmG093NlfIGfxMmK4ntvFMEc2dgwqSuOPz02tVXlcS+ahzLT9rqsI2C67B0b2XBEP
X-NP-GRANT-CODE: C2eyDV
Cache-Control: no-cache, no-store, max-age=0, must-revalidate
Pragma: no-cache
Expires: 0
Content-Language: en-GB
Content-Length: 0
Content-Type: text/plain; charset=UTF-8
Date: Fri, 18 Mar 2016 02:31:16 GMT
Connection: close


Get the token:

POST /2.0/oauth/token HTTP/1.1
Host: auth.api.sonyentertainmentnetwork.com
Proxy-Connection: keep-alive
Accept: */*
Accept-Encoding: gzip, deflate
Cookie: JSESSIONID=3DA615B8EC9C0C28CF9A291F98A6FB75.lvp-p1-npversat49-4709; npsso=2PTQnPB1YE4ghBn73ygiTZ6K3rozcR4ykkCiwJHvDYU094FGaB10UusPK3U2NPY2; s_cc=true; s_fid=2BB214FFEDC9A6B5-2F2CB87275E626F5; s_prepagename=ios%3Apdr%3Asignin%3Aentrance%20signin; s_sq=%5B%5BB%5D%5D
Content-Type: application/x-www-form-urlencoded
Accept-Language: en-GB;q=1
Content-Length: 549
Connection: keep-alive
User-Agent: PlayStationApp/3.20.2 (iPhone; iOS 9.2.1; Scale/2.00)

client_id=4db3729d-4591-457a-807a-1cf01e60c3ac&client_secret=criemouwIuVoa4iU&code=C2eyDV&duid=0000000d00040080385B97FEDAAD42A28916D9082210BBDD&grant_type=authorization_code&redirect_uri=com.playstation.PlayStationApp%3A%2F%2Fredirect&scope=psn%3Asceapp%2Cuser%3Aaccount.get%2Cuser%3Aaccount.settings.privacy.get%2Cuser%3Aaccount.settings.privacy.update%2Cuser%3Aaccount.realName.get%2Cuser%3Aaccount.realName.update%2Ckamaji%3Aget_account_hash%2Ckamaji%3Augc%3Adistributor%2Coauth%3Amanage_device_usercodes&service_entity=urn%3Aservice-entity%3Apsn

Response:

HTTP/1.1 200 OK
Server: Apache
x-wily-info: Clear guid=879009360AD3356514E4CC0F221523E4
x-wily-servlet: Encrypt1 hR/KG2GOR16aRfvv3/q1AYmRuJmOee/Y5s5imluJ6HPZPHI/6MY8f3YcYCYHUfK9zSCSozCJbOlOnOe8e4ZK7Ekf6UfnlPgROsyFTGNoIQV1tTTp50Ge98wBtnDTps6QmG093NlfIGfxMmK4ntvFMEc2dgwqSuOPz02tVXlcS+ahzLT9rqsI2C67B0b2XBEP
Cache-Control: no-store
Pragma: no-cache
Content-Type: application/json;charset=UTF-8
Date: Fri, 18 Mar 2016 02:31:17 GMT
Transfer-Encoding: chunked
Connection: close
Connection: Transfer-Encoding
Set-Cookie: npsso=3pHtRKUPtPmndhhPKiLLe9lDmUV3RmDce1P1zW6pWpJXo1KKTH4X6XBfEs9I4Pva; expires=Tue, 17-May-2016 02:31:17 GMT; path=/; secure

{"access_token":"58cb9074-62d6-4558-88c1-17303461a98d","token_type":"bearer","refresh_token":"68cbb517-e234-4ce4-8781-56335a9d46cb","expires_in":3599,"scope":"psn:sceapp user:account.get user:account.realName.get kamaji:ugc:distributor user:account.settings.privacy.update user:account.realName.update kamaji:get_account_hash user:account.settings.privacy.get oauth:manage_device_usercodes"}

Test token:

GET /2.0/oauth/token/58cb9074-62d6-4558-88c1-17303461a98d?client_id=4db3729d-4591-457a-807a-1cf01e60c3ac&client_secret=criemouwIuVoa4iU&code=C2eyDV&duid=0000000d00040080385B97FEDAAD42A28916D9082210BBDD&grant_type=authorization_code&redirect_uri=com.playstation.PlayStationApp%3A%2F%2Fredirect&scope=psn%3Asceapp%2Cuser%3Aaccount.get%2Cuser%3Aaccount.settings.privacy.get%2Cuser%3Aaccount.settings.privacy.update%2Cuser%3Aaccount.realName.get%2Cuser%3Aaccount.realName.update%2Ckamaji%3Aget_account_hash%2Ckamaji%3Augc%3Adistributor%2Coauth%3Amanage_device_usercodes&service_entity=urn%3Aservice-entity%3Apsn HTTP/1.1
Host: auth.api.sonyentertainmentnetwork.com
Authorization: Basic NGRiMzcyOWQtNDU5MS00NTdhLTgwN2EtMWNmMDFlNjBjM2FjOmNyaWVtb3V3SXVWb2E0aVU=
Accept-Encoding: gzip, deflate
Accept: */*
Cookie: JSESSIONID=3DA615B8EC9C0C28CF9A291F98A6FB75.lvp-p1-npversat49-4709; npsso=3pHtRKUPtPmndhhPKiLLe9lDmUV3RmDce1P1zW6pWpJXo1KKTH4X6XBfEs9I4Pva; s_cc=true; s_fid=2BB214FFEDC9A6B5-2F2CB87275E626F5; s_prepagename=ios%3Apdr%3Asignin%3Aentrance%20signin; s_sq=%5B%5BB%5D%5D
Accept-Language: en-GB;q=1
Connection: keep-alive
Proxy-Connection: keep-alive
User-Agent: PlayStationApp/3.20.2 (iPhone; iOS 9.2.1; Scale/2.00)


HTTP/1.1 200 OK
Server: Apache
x-wily-info: Clear guid=87900ABB0AD3356514E4CC0F4D13F726
x-wily-servlet: Encrypt1 hR/KG2GOR16aRfvv3/q1AYmRuJmOee/Y5s5imluJ6HPZPHI/6MY8f3YcYCYHUfK9zSCSozCJbOlOnOe8e4ZK7Ekf6UfnlPgROsyFTGNoIQV1tTTp50Ge98wBtnDTps6QmG093NlfIGfxMmK4ntvFMEc2dgwqSuOPz02tVXlcS+ahzLT9rqsI2C67B0b2XBEP
Cache-Control: private, must-revalidate, max-age=3599
Expires: Fri, 18 Mar 2016 03:31:17 GMT
Content-Type: application/json;charset=UTF-8
Content-Length: 612
Date: Fri, 18 Mar 2016 02:31:17 GMT
Connection: close

{"scopes":"kamaji:get_account_hash kamaji:ugc:distributor oauth:manage_device_usercodes psn:sceapp user:account.get user:account.realName.get user:account.realName.update user:account.settings.privacy.get user:account.settings.privacy.update","expiration":"2016-03-18T03:31:17.053Z","user_id":"2125866694095514939","user_uuid":"f496a09e-73d9-418c-a5b7-13093404f3c9","client_id":"4db3729d-4591-457a-807a-1cf01e60c3ac","dcim_id":"ce2fe82d-2c9e-4b58-9cbf-c59fc3a86e45","is_sub_account":false,"duid":"0000000d00040080385B97FEDAAD42A28916D9082210BBDD","country_code":"GB","language_code":"en","device_type":"IOS_APP"}