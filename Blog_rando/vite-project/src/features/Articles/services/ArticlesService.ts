import axios from '../../../lib/axios'


export const getAllArticles = async () => {

    try {
        const response = await axios.get(`/api/getArticles`);
        if (response.status === 200) {
            console.log(response.data);
            return response.data
        }
    } catch (error) {
        throw new Error("Error fetching articles");
    }
}