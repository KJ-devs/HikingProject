import axios from '../../../lib/axios'

export const getAllArticles = async () => {
    try {
        const response = await axios.get(`/api/getArticles`);
        if (response.status === 200) {
            console.log(response.data);
            return response.data; // Return the data if successful
        } else {
            throw new Error("Failed to fetch articles"); // Throw an error if the response status is not 200
        }
    } catch (error) {
        console.error("Error fetching articles:"
        );
        throw new Error("Error fetching articles"); // Throw a new error to handle in the caller function
    }
};
