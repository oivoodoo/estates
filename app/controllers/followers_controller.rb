class FollowersController < ApplicationController
	def create
		@follower = Follower.new
		@follower.project_id = params[:project_id]
		@follower.project_id = current_user.id 
	end
end
