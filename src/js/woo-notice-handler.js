import { AlertDisplay as AD } from './alert-display';

export class HandleWooMessage
{
    process(messageObj){
        let res = [];
        let notice = messageObj.data.notice;
        if(Object.keys(notice).length === 0){
            return res;
        }
        let message = "";
        let alert = new AD();
        for(const key in notice){
            for(const index in notice[key]){
                message = notice[key][index]['notice'];
                alert.showAlert("Warning", message);
            }
        }
        return res;
    }
}