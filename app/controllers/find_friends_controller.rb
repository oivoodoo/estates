class FindFriendsController < ApplicationController
  def index
    current_user.authentications[0] = FbGraph::User.new('me', :access_token => auth.credentials.token).fetch.friends
  end
end